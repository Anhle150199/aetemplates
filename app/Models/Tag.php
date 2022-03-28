<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'ae_tags';

    protected $fillable = [
        'tag_name',
        'posts_count'
    ];

    public $timestamps = true;

}
