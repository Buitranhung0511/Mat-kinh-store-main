<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users'; // Ensure this matches your table name

    // Primary Key
    public $primaryKey = 'user_id';

    // Timestamps
    public $timestamps = true;

    // Fillable Fields
    protected $fillable = [
        'user_name',
        'user_email ',
        'user_phone',
        'user_password',
    ];
}
