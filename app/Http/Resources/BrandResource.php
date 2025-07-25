<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'image'     => $this->image,
            'url'       => $this->url,
            'status'    => (bool) $this->status,
            'created_at'=> $this->created_at->toDateTimeString(),
            'updated_at'=> $this->updated_at->toDateTimeString(),
        ];
    }
}
