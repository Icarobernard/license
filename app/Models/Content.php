<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'title',
        'description',
        'status',
        'image',
        'video_url',
        'content_type',
        'custom_content',
        'rank',
    ];
}
