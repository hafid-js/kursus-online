<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsSectionResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'rounded_text' => $this->rounded_text,
            'learner_count' => $this->learner_count,
            'learner_count_text' => $this->learner_count_text,
            'learner_image' => $this->learner_image,
            'title' => $this->title,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
            'video_url' => $this->video_url,
            'video_image' => $this->video_image,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
