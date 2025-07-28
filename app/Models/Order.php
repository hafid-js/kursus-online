<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'buyer_id',
        'status',
        'total_amount',
        'paid_amount',
        'currency',
        'has_coupon',
        'coupon_code',
        'coupon_amount',
        'transaction_id',
        'payment_method',
    ];

    public function customer() : BelongsTo {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function orderItems() : HasMany {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
