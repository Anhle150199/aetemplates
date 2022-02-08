<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRelationship extends Model
{
    use HasFactory;
    protected $table = 'ae_categories_relationship';

    protected $fillable = [
        'cate_id',
        'post_id',
    ];
}
