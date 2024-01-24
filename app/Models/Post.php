<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts'; // Ensure this matches your table name

    // Primary Key
    public $primaryKey = 'post_id';

    // Timestamps
    public $timestamps = true;

    // Fillable Fields
    protected $fillable = [
        'post_title ',
        'post_desc',
        'post_content',
        'post_image',
        'post_status',
        'category_posts_id',
    ];

    public function cate_post()
    {
        return $this->belongsTo(CategoryPost::class, 'category_posts_id');
    }
}
