<?php

namespace App\Http\Resources;

use App\Models\Guide\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Topic
 */
class TopicResource extends JsonResource
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
            'name' => $this->name,
            'desc' => $this->desc,
            'projectId' => $this->project_id,
            $this->mergeWhen($name !== 'dashboard', [
                'categoryPosts' => PostResource::collection($this->categoryPosts),
                'posts' => PostResource::collection($this->posts),
                'notes' => $this->notes,
                'categoryLinks' => $this->categoryLinks,
            ]),
            "createdAt" => optional($this->created_at)->format('Y-m-d'),
            "updatedAt" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
