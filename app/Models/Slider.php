<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'slider_name',
        'slider_image',
        'slider_status',
        'slider_desc',

    ];
    protected $table = 'slider';
    protected $primarykey = 'id';
}
//
