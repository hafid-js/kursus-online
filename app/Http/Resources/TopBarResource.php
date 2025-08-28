<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopBarResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'offer_name' => $this->offer_name,
            'offer_short_description' => $this->offer_short_description,
            'offer_button_text' => $this->offer_button_text,
            'offer_button_url' => $this->offer_button_url,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
