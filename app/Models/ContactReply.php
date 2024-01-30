<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    use HasFactory;

    // Khai báo các thuộc tính

    // reply_message là nội dung phản hồi của bạn. Bạn cần khai báo thuộc tính này để lưu trữ nội dung phản hồi trong đối tượng ContactReply.
    protected $reply_message;

    // contact_id là ID của liên hệ mà bạn đang phản hồi. Bạn cần khai báo thuộc tính này để liên kết phản hồi với liên hệ tương ứng.
    protected $contact_id;


    // Phương thức khởi tạo
    public function __construct($reply_message, $contact_id)
    {
        // Thiết lập các thuộc tính

        $this->reply_message = $reply_message;
        $this->contact_id = $contact_id;
    }
}
