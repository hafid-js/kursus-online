<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'buyer_id' => $this->buyer_id,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'currency' => $this->currency,
            'has_coupon' => (bool) $this->has_coupon,
            'coupon_code' => $this->coupon_code,
            'coupon_amount' => $this->coupon_amount,
            'transaction_id' => $this->transaction_id,
            'payment_method' => $this->payment_method,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
