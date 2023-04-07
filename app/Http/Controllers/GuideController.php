<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guide\Post;
use App\Models\Guide\Link;
use App\Models\Guide\Note;
use App\Models\Guide\Topic;
use App\Models\Guide\Project;
use App\Http\Resources\LinkResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\NoteResource;
use App\Http\Resources\TopicResource;
use App\Http\Resources\ProjectResource;

class GuideController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function update(Request $request): array
    {
        $time = Carbon::now();
        $data = $request->post();
        $result = \DB::table('guide_'. $data['table'])
            ->where('id', $data['id'])
            ->update([
                $data['field'] => $data['value'],
                'updated_at' => $time
            ]);

        return $result ? [
            'success' => true,
            'updatedAt' => $time->format('Y-m-d')
        ] : ['success' => false];
    }

    /**
     * @param Request $request
     * @return JsonResource
     * @throws Exception
     */
    public function create(Request $request): JsonResource
    {
        $table = $request->post('table');
        $data = $request->post('data');
        switch ($table) {
            case 'notes':
                $note = Note::create($data);
                return NoteResource::make($note);
            case 'topics':
                $topic = Topic::create($data);
                return TopicResource::make($topic);
            case 'projects':
                $project = Project::create($data);
                return ProjectResource::make($project);
            case 'posts':
                $post = Post::create($data);
                return PostResource::make($post);
            case 'links':
                $postId = $data['post_id'] ?? null;
                $noteId = $data['note_id'] ?? null;
                if (!($postId xor $noteId)) {
                    throw new Exception('One of both - Post ID or Note ID - required for creating: ' . $table);
                }
                $max = (int) Link::where('post_id', $postId)
                        ->where('note_id', $noteId)->max('number');
                $data['number'] = ++$max;
                $link = Link::create($data);
                return LinkResource::make($link);
            default: throw new Exception('Unknown table: ' . $table);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function delete(Request $request): array
    {
        $data = $request->post();
        $result = \DB::table('guide_'. $data['table'])
            ->where('id', $data['id'])
            ->delete();

        return ['result' => $result];
    }
}
