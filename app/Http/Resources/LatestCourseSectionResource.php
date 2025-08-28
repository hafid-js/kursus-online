<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LatestCourseSectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'category_one' => $this->category_one,
            'category_two' => $this->category_two,
            'category_three' => $this->category_three,
            'category_four' => $this->category_four,
            'category_five' => $this->category_five,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
