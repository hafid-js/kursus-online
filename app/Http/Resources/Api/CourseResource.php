<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,

            'thumbnail' => $this->thumbnail ? url($this->thumbnail) : null,
            'price' => $this->price,
            'instructor_name' => $this->instructor?->name,
            'review_count' => $this->reviews_count ?? $this->reviews->count(),
        ];
    }
}
