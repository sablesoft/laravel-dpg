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
        $name = $request->route()->getName();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'notes' => NoteResource::collection($this->notes->keyBy('id')),
            $this->mergeWhen($name !== 'dashboard', [
                'posts' => PostResource::collection($this->posts->keyBy('id')),
                'topics' => TopicResource::collection($this->topics->keyBy('id'))
            ]),
            "createdAt" => optional($this->created_at)->format('Y-m-d'),
            "updatedAt" => optional($this->updated_at)->format('Y-m-d'),
        ];
    }
}
