<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'order_id'        => $this->order_id,
            'course_id'       => $this->course_id,
            'qty'             => $this->qty,
            'price'           => $this->price,
            'commission_rate' => $this->commission_rate,
            'item_type'       => $this->item_type,
            'created_at'      => $this->created_at?->toDateTimeString(),
            'updated_at'      => $this->updated_at?->toDateTimeString(),

            'order'  => OrderResource::whenLoaded($this->order),
            'course' => CourseResource::whenLoaded($this->course),
        ];
    }
}
