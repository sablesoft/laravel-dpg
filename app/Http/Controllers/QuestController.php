<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class QuestController extends Controller
{
    /**
     * @param string $code
     * @return Response
     */
    public function run(string $code): Response
    {
        return Inertia::render("QuestJS/Game/$code/Game", []);
    }

    /**
     * @return array|mixed
     */
    public function ai()
    {
        $key = getenv('OPEN_AI_KEY');
        $client = \OpenAI::client($key);

        $formats = <<<FORMATS
Response formats:
 - Glance - one small sentence. Don't use the Entourage. Use no more than two random Keywords.
 - Look (default if not specified) - one small paragraph in three sentences.  Use no more than four random Keywords. Use only one random item from the Entourage.
 - Examine - maximum two paragraphs of text of three sentences each. Use no more than three random items from the Entourage.
 - Story - detailed description, limited only by the context window.
Always use the Purpose and Background. Always replace "player" with "you".
FORMATS;

        $request = <<<REQUEST
Purpose: The player relaxes.
Place: kitchen
Background: visited before, now sitting on the sofa, melancholy, noon, autumn, heavy rain.
Map: parents' house
Keywords: small, cozy, clean, pleasant smell, warm.
Entourage: a table, three chairs, a window to the garden, a sofa, a stove, a sink, mezzanines, a refrigerator, a locker.

Give a one small paragraph in three sentences. Use no more than four random Keywords. Use only one random item from the Entourage.
REQUEST;

        $instruction = 'Act as a copywriter for the text adventure system. Strictly adhere to user request requirements.'.
            'Never add any comments, only the requested text. Always replace "player" with "you". Translate response to Russian';

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $instruction
                ],
                [
                    'role' => 'user',
                    'content' => $request
                ],
            ],
        ]);

        return $response->toArray();
    }
}
