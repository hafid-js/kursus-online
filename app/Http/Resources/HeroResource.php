<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HeroResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
            'video_button_text' => $this->video_button_text,
            'video_button_url' => $this->video_button_url,
            'banner_item_title' => $this->banner_item_title,
            'banner_item_subtitle' => $this->banner_item_subtitle,
            'image' => $this->image,
            'round_text' => $this->round_text,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
