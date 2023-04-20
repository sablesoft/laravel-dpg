<?php

namespace App\Http\Controllers;

use App\Models\Guide\UseNumber;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guide\Tag;
use App\Models\Guide\Post;
use App\Models\Guide\Link;
use App\Models\Guide\Note;
use App\Models\Guide\Topic;
use App\Models\Guide\Project;
use App\Http\Resources\TagResource;
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
     * @throws Exception
     */
    public function update(Request $request): array
    {
        $time = Carbon::now();
        $data = $request->post();
        if ($data['field'] === 'number') {
            $result = $this->updateNumber($data, $time);
        } else {
            $result = \DB::table('guide_'. $data['table'])
                ->where('id', $data['id'])
                ->update([
                    $data['field'] => $data['value'],
                    'updated_at' => $time
                ]);
        }

        return $result ? [
            'success' => true,
            'updatedAt' => $time->format('Y-m-d'),
            'result' => $result
        ] : ['success' => false];
    }

    /**
     * @param array $data
     * @param Carbon $time
     * @return array|null
     * @throws Exception
     */
    protected function updateNumber(array $data, Carbon $time): ?array
    {
        switch ($data['table']) {
            case 'notes':
                /** @var UseNumber $item */
                $item = Note::findOrFail($data['id']);
                break;
            case 'posts':
                /** @var UseNumber $item */
                $item = Post::findOrFail($data['id']);
                break;
            case 'links':
                /** @var UseNumber $item */
                $item = Link::findOrFail($data['id']);
                break;
            default:
                throw new Exception('Unknown entity for number updating: '. $data['table']);
        }
        $query = $item->numbersQuery();
        $next = $query->max('number') + 1;
        $ids = $query->orderBy('number')->pluck('id')->toArray();
        $ids = $this->changePosition($ids, $item->number, $data['value']);
        foreach ($ids as $index => $id) {
            \DB::table('guide_'. $data['table'])
                ->where('id', $id)
                ->update([
                    'number' => $next + $index,
                    'updated_at' => $time
                ]);
        }
        foreach ($ids as $index => $id) {
            \DB::table('guide_'. $data['table'])
                ->where('id', $id)
                ->update([
                    'number' => 1 + $index,
                    'updated_at' => $time
                ]);
        }

        return \DB::table('guide_'. $data['table'])
                ->whereIn('id', $ids)->select(['id', 'number'])
                ->orderBy('number')->get()->toArray();
    }

    /**
     * @param $ids
     * @param $old
     * @param $new
     * @return array
     */
    protected function changePosition($ids, $old, $new): array
    {
        $out = array_splice($ids, $old - 1, 1);
        array_splice($ids, $new - 1, 0, $out);

        return $ids;
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
                $postId = $data['post_id'] ?? null;
                $projectId = $data['project_id'] ?? null;
                if (!$number = Note::allowedNumber($postId, $projectId)) {
                    throw new Exception('One of both - Post ID or Project ID - required for creating: ' . $table);
                }
                $data['number'] = $number;
                $note = Note::create($data);
                return NoteResource::make($note);
            case 'topics':
                $topic = Topic::create($data);
                return TopicResource::make($topic);
            case 'projects':
                $project = Project::create($data);
                return ProjectResource::make($project);
            case 'posts':
                $categoryId = $data['category_id'];
                $data['number'] = Post::allowedNumber($categoryId);
                $post = Post::create($data);
                return PostResource::make($post);
            case 'links':
                $postId = $data['post_id'] ?? null;
                $noteId = $data['note_id'] ?? null;
                if (!$number = Link::allowedNumber($postId, $noteId)) {
                    throw new Exception('One of both - Post ID or Note ID - required for creating: ' . $table);
                }
                $data['number'] = $number;
                $link = Link::create($data);
                return LinkResource::make($link);
            case 'tags':
                $tag = Tag::create($data);
                return TagResource::make($tag);
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
