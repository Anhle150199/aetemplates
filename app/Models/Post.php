<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'ae_posts';

    protected $fillable = [
        'user_id',
        'post_title',
        'post_excerpt',
        'post_content',
        'post_type',
        'post_slug',
        'post_thumbnail',
        'post_views',
        'updated_at'
    ];
}
