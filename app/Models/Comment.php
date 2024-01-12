<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // public $timestamps = false; // set time to false
    protected $fillable = [
        'comment',
        'comment_name',
        'comment_email',
        'comment_date',
        'comment_status',
        'product_id',
    ];

    protected $primaryKey = 'comment_id';
    protected $table = 'comments';
    public $timestamps = false; // set time to false
   

    
}