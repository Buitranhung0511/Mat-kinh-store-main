<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Member;
use Illuminate\Support\Facades\Redirect;

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
        $member = Member::where('email', $request->input('email'))->first();

        if ($member) {

            // Lưu dữ liệu vào database
            $contact = new Contact();
            $contact->contact_name = $request->input('fullname');
            $contact->contact_email = $request->input('email');
            $contact->contact_phone = $request->input('phone');
            $contact->contact_message = $request->input('message');
            $contact->contact_status = 'pending'; // Gán giá trị mặc định cho trường status
            $contact->id = $member->id; // Gán ID của thành viên
            $contact->save();

            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Member with the provided email does not exist!');
        }
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
