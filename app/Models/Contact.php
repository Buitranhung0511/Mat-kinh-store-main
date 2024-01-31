<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_message',
        'contact_status',
        // 'customer_id'
    ];

    protected $primaryKey = 'contact_id';
    protected $table = 'contact';
}
