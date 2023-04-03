<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guide\Post;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
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
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'category_id' => $this->category_id,
            'topic_id' => $this->topic_id,
            'title' => $this->title,
            'notes' => NoteResource::collection($this->notes->keyBy('id')),
            "created_at" => optional($this->created_at)->format('Y-m-d'),
            "updated_at" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
