<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'ae_images';

    protected $fillable = [
        'img_name'
    ];
    public $timestamps = true;

}
