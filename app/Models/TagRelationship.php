<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRelationship extends Model
{
    use HasFactory;
    protected $table = 'ae_tags_relationship';

    protected $fillable = [
        'tag_id',
        'post_id'
    ];
}
