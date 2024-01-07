<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_quantity',
        'product_price',
        'product_image',
        'category_name',
        'product_status',

    ];
    protected $table = 'product';
    use HasFactory;
}
//
