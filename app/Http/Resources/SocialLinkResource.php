<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialLinkResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'icon'      => $this->icon,
            'url'       => $this->url,
            'status'    => (bool) $this->status,
            'created_at'=> $this->created_at?->toDateTimeString(),
            'updated_at'=> $this->updated_at?->toDateTimeString(),
        ];
    }
}
