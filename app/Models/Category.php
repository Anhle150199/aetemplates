<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'ae_categories';

    protected $fillable = [
        'cate_name',
        'cate_slug',
        'cate_level',
        'parent_id',
        'children_count',
        'cate_type',
        'posts_count',
    ];
}
