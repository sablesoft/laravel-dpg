<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guide\Tag;

/**
 * @mixin Tag
 */
class TagResource extends JsonResource
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
            'entity' => 'tag',
            'projectId' => $this->project_id,
            'postId' => $this->post_id,
            'topicId' => $this->topic_id,
            "createdAt" => optional($this->created_at)->format('Y-m-d'),
            "updatedAt" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
