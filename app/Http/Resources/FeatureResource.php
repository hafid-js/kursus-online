<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'features' => [
                'one' => [
                    'image' => $this->image_one,
                    'title' => $this->title_one,
                    'subtitle' => $this->subtitle_one,
                ],
                'two' => [
                    'image' => $this->image_two,
                    'title' => $this->title_two,
                    'subtitle' => $this->subtitle_two,
                ],
                'three' => [
                    'image' => $this->image_three,
                    'title' => $this->title_three,
                    'subtitle' => $this->subtitle_three,
                ],
            ],
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
