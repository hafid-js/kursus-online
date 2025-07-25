<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'description' => $this->description,
            'copyright'   => $this->copyright,
            'phone'       => $this->phone,
            'address'     => $this->address,
            'email'       => $this->email,
            'created_at'  => $this->created_at?->toDateTimeString(),
            'updated_at'  => $this->updated_at?->toDateTimeString(),
        ];
    }
}
