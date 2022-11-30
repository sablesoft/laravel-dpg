<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Card;
use App\Exceptions\CopyException;
use App\Exceptions\ImageException;

class CopyService
{
    /**
     * @param Card $source
     * @param array $config
     * @return Card
     * @throws CopyException|ImageException
     */
    public static function copyCard(Card $source, array $config): Card
    {
        /** @var User $user */
        $user = array_key_exists('user', $config) ?
            $config['user'] : Auth::user();

        $bookId = array_key_exists('book_id', $config) ?
            $config['book_id'] : null;

        $filename = ImageService::copyImage($source->image);
        $card = $source->replicate();
        $card->image = $filename;
        $card->created_at = Carbon::now();
        $card->is_public = false;
        $card->owner_id = $user->getKey();
        $card->name = $card->name . ' - COPY';

        if (!$card->save()) {
            throw new CopyException('Copy card save error');
        }
        if ($bookId) {
            $card->books()->attach($bookId);
        }

        return $card;
    }
}
