<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageRelationship extends Model
{
    use HasFactory;
    protected $table = 'ae_images_relationship';

    protected $fillable = [
        'img_name',
        'post_id',
    ];
    public $timestamps = true;

}
