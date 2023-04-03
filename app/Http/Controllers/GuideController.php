<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guide\Note;
use App\Models\Guide\Topic;
use App\Models\Guide\Project;
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
        $data = $request->post();
        $result = \DB::table('guide_'. $data['table'])
            ->where('id', $data['id'])
            ->update([$data['field'] => $data['value']]);

        return ['result' => $result];
    }

    /**
     * @param Request $request
     * @return JsonResource
     * @throws Exception
     */
    public function create(Request $request): JsonResource
    {
        $data = $request->post();
        switch ($data['table']) {
            case 'notes':
                $note = Note::create($data['data']);
                return NoteResource::make($note);
            case 'topics':
                $topic = Topic::create($data['data']);
                return TopicResource::make($topic);
            case 'projects':
                $project = Project::create($data['data']);
                return ProjectResource::make($project);
            default: throw new Exception('Unknown table: ' . $data['table']);
        }
    }
}
