<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'instructor_id'  => $this->instructor_id,
            'amount'         => (float) $this->amount,
            'status'         => $this->status,
            'transaction_id' => $this->transaction_id,
            'created_at'     => $this->created_at?->toDateTimeString(),
            'updated_at'     => $this->updated_at?->toDateTimeString(),
        ];
    }
}
