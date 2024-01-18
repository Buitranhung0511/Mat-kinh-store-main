<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $primaryKey = 'discount_id';
    protected $fillable = [

        'discount_name',
        'discount_code',
        'discount_percent',
        'discount_status',
        'start_date',
        'end_date',
    ];
    protected $table = 'discounts';
    use HasFactory;
    public static function findByCodeAndDate($code, $day)
    {
        // Tìm kiếm discount dựa trên 'code' và kiểm tra xem ngày có nằm trong khoảng start_date và end_date
        return self::where('discount_code', $code)
                   ->where('start_date', '<=', $day)
                   ->where('end_date', '>=', $day)
                   ->first();
    }
}
//