<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CounterResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'counter_one' => $this->counter_one,
            'title_one' => $this->title_one,
            'counter_two' => $this->counter_two,
            'title_two' => $this->title_two,
            'counter_three' => $this->counter_three,
            'title_three' => $this->title_three,
            'counter_four' => $this->counter_four,
            'title_four' => $this->title_four,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
