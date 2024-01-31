<?php

namespace App\Http\Controllers;

use App\Mail\ContactReplyMail;
use App\Mail\Email;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactReply;
use App\Models\Member;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{

    // Show contact
    public function show_contact()
    {
        $all_message = Contact::paginate(20);
        return view('admin.contact.all_message', ['all_message' => $all_message]);
    }

    // Hàm xử lý submitForm
    public function submitForm(Request $request)
    {
        // Kiểm tra dữ liệu từ form
        $validateData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'nullable|string|max:11',
            'message' => 'required|string',

        ]);

        // Lấy email tương ứng với bảng member
        $member = UserProfile::where('customer_email', $request->input('customer_email'))->first();

        if ($member) {

            // Lưu dữ liệu vào database
            $contact = new Contact();
            $contact->contact_name = $request->input('fullname');
            $contact->contact_email = $request->input('email');
            $contact->contact_phone = $request->input('phone');
            $contact->contact_message = $request->input('message');
            $contact->contact_status = 'pending'; // Gán giá trị mặc định cho trường status
            // $contact->customer_id = $member->customer_id; // Gán ID của thành viên
            $contact->save();

            // Gửi email với nội dung mặc định từ view default_email.blade.php
            Mail::send('mail', ['name' => $request->input('fullname')], function ($message) use ($request) {
                $message->to($request->input('email'))->subject('Thank you for contacting us!');
            });
        } else {
            return redirect()->back()->with('error', 'Member with the provided email does not exist!');
        }
    }

    public function replyMessage(Request $request, $contact_id)
    {
        // Lấy dữ liệu phản hồi từ request
        $replyMessage = $request->input('reply_message');

        // Lấy thông tin liên hệ theo ID
        $contact = Contact::find($contact_id);

        // Tạo đối tượng ContactReply
        $reply = new ContactReply('reply_message', 'contact_id');

        // Thiết lập các thuộc tính của đối tượng ContactReply
        $reply->contact_id = $contact_id;
        $reply->reply_message = $replyMessage;

        // Lưu trữ phản hồi
        $reply->save();

        // Gửi email phản hồi
        Mail::to($contact->contact_email)->send(new ContactReplyMail($reply));

        // Hiển thị thông báo thành công hoặc thất bại
        if ($reply) {
            Session::flash('message', 'Phản hồi đã được gửi thành công!');
        } else {
            Session::flash('message1', 'Đã xảy ra lỗi khi gửi phản hồi!');
        }

        // Quay lại trang danh sách liên hệ
        return redirect()->route('show-message');
    }

    public function showReplyForm(Request $request)
    {
        // Lấy ID liên hệ từ tham số `id` trong URL
        $contact_id = $request->route('id');

        // Tìm kiếm thông tin liên hệ theo ID
        $contact = Contact::find($contact_id);

        // Nếu không tìm thấy liên hệ, hiển thị thông báo lỗi
        if (!$contact) {
            return redirect()->route('show-message')->with('message', 'Không tìm thấy liên hệ!');
        }

        // Trả về view chứa biểu mẫu phản hồi với thông tin liên hệ đã tìm được
        return view('contact.reply', [
            'contact' => $contact,
        ]);
    }

    public function delete_message($contact_id)
    {
        $message = Contact::where('contact_id', $contact_id)->delete();
        return  Redirect::to('show-contact')->with('success', 'The Message Has Been Deleted Successfully !');
    }

    public function search_message(Request $request)
    {
        $all_message = Contact::where('contact_name', 'like', '%' . $request->search_message . '%')->paginate(20);

        return view('admin.contact.all_message', ['all_message' => $all_message->isEmpty() ? null : $all_message]);
    }
}
