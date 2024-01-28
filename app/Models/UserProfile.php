<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $table = 'customers'; // Đặt tên bảng tương ứng trong cơ sở dữ liệu
    public $primaryKey = 'customer_id';
    protected $fillable = ['customer_name', 'customer_email', 'customer_phone', 'customer_address','customer_password','customer_img'];

}
