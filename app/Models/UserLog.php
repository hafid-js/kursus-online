<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{

     use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'location',
        'operating_system',
        'browser',
        'user_agent',
        'accessed_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
