<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'user'             => new UserResource($this->whenLoaded('user')),
            'category'         => new BlogCategoryResource($this->whenLoaded('blogCategory')),
            'image'            => $this->image,
            'title'            => $this->title,
            'slug'             => $this->slug,
            'description'      => $this->description,
            'status'           => (bool) $this->status,
            'created_at'       => $this->created_at?->toDateTimeString(),
            'updated_at'       => $this->updated_at?->toDateTimeString(),
        ];
    }
}
