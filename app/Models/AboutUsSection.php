<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'rounded_text',
        'learner_count',
        'learner_count_text',
        'title',
        'description',
        'button_text',
        'button_url',
        'video_url',
        'image',
        'learner_image',
        'video_image'
    ];
}
