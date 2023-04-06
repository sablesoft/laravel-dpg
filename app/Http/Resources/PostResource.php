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
            'entity' => 'post',
            'desc' => $this->desc,
            'projectId' => $this->project_id,
            'categoryId' => $this->category_id,
            'topicId' => $this->topic_id,
            'noteIds' => $this->notes->modelKeys(),
            'linkIds' => $this->links->modelKeys(),
            'targetLinkIds' => $this->targetLinks->modelKeys(),
            "createdAt" => optional($this->created_at)->format('Y-m-d'),
            "updatedAt" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
