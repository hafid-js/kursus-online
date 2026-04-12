<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'headline' => $this->headline,

            // aggregated fields
            'courses_count' => $this->courses_count ?? 0,
            'students_count' => $this->students_count ?? 0,
        ];
    }
}
