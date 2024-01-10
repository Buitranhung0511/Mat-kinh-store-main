<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatirticModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_statistical'; // Replace 'your_table_name' with the actual table name

    protected $fillable = [
        'order_date',
        'sales',
        'profit',
        'quantity',
        'total_order',
    ];
}