<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'customer_name',
        'email',
        'phone_number',
        'product_name',
        'quantity',
        'product_price',
        'total_amount',
        'shipping_address',
        'shipping_method',
        'expected_delivery_date',
        'payment_method',
        'payment_status',
        'order_status',
        'additional_notes',
        'discount_code',
        'total_discount',
        'tax_amount',
        'user_account_id',
        'refund_status',
        'refund_notes',
    ];
    // public function userAccount()
    // {
    //     return $this->belongsTo(UserAccount::class, 'user_account_id');
    // }
}