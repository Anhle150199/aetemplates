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
        'parrent_id',
        'cate_type',
        'posts_count'
    ];
}
