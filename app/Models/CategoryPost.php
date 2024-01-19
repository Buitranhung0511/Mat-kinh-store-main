<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    protected $table = 'category_posts'; // Ensure this matches your table name

    // Primary Key
    public $primaryKey = 'category_posts_id';

    // Timestamps
    public $timestamps = true;

    // Fillable Fields
    protected $fillable = [
        'category_posts_id',
        'category_posts_name ',
        'category_posts_status',
        'category_posts_desc',
    ];
}
