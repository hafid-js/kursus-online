<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CertificateBuilderResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'background' => $this->background,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'signature' => $this->signature,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
