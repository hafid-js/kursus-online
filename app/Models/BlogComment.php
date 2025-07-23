<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','blog_id','parent_id','comment'];

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function parent() {
        return $this->belongsTo(BlogComment::class,'parent_id');
    }

    public function children() {
        return $this->hasMany(BlogComment::class,'parent_id');
    }

    public function blog() {
        return $this->belongsTo(Blog::class);
    }
}
