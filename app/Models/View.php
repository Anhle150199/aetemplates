<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $table = 'ae_views';

    protected $fillable = [
        'id_current',
        'period',
        'views'
    ];
    public $timestamps = false;

}
