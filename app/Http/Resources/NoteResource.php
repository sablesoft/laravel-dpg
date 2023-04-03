<?php

namespace App\Http\Resources;

use App\Models\Guide\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Note
 */
class NoteResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public bool $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $name = $request->route()->getName();
        return [
            'id' => $this->id,
            'projectId' => $this->project_id,
            'postId' => $this->post_id,
            'topicId' => $this->topic_id,
            'title' => $this->title,
            'content' => $this->content,
            $this->mergeWhen($name !== 'dashboard', [
                'topic' => TopicResource::make($this->topic),
            ]),
            "createdAt" => optional($this->created_at)->format('Y-m-d'),
            "updatedAt" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
