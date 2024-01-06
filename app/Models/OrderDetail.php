<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_name',
        'quantity',
        'product_price',
        'subtotal_amount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}