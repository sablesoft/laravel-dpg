<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guide\Project;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
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
            'entity' => 'project',
            'name' => $this->name,
            'code' => $this->code,
            'text' => $this->text,
            'tagIds' => $this->tags->modelKeys(),
            'noteIds' => $this->notes->modelKeys(),
            'postIds' => $this->posts->modelKeys(),
            'topicIds' => $this->topics->modelKeys(),
            'moduleIds' => $this->modules->modelKeys(),
            "createdAt" => optional($this->created_at)->format('Y-m-d'),
            "updatedAt" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
