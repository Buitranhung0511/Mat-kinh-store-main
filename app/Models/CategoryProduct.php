<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{

    protected $fillable = [
        'category_name',
        'category_status',

    ];
    protected $table = 'category_product';
    use HasFactory;
}
//
