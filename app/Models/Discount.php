<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $primaryKey = 'discount_id';
    protected $fillable = [

        'discount_name',
        'product_id',
        'discount_code',
        'discount_percent',
        'discount_status',
        'start_date',
        'end_date',
    ];
    protected $table = 'discounts';
    use HasFactory;
}
//
