<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

     function course() : BelongsTo {
        return $this->belongsTo(Course::class, 'course_id','id');
    }

    function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id','id');
    }

     public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }
}
