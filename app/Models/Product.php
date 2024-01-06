<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'product'; // Ensure this matches your table name

    // Primary Key
    public $primaryKey = 'product_id';

    // Timestamps
    public $timestamps = true;

    // Fillable Fields
    protected $fillable = [
        'category_id',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status'
    ];
}