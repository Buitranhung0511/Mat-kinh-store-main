<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class MemberController extends Controller
{
    //hàm xử lý trả về trang register
    public function create()
    {
        return view('admin.register_member');
    }

    //hàm xử lý xác thực từ form để trả về
    public function store(Request $request)
    {
        // phương thức sử lý xác thực các trường đăng ký có hợp lệ hay không..
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:member',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'yob' => 'required|integer',
        ]);

        //Sử dụng phương thức $request gửi tới server các trường từ input
        $member = new Member([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'yob' => $request->input('yob'),
        ]);

        $member->save();
        Session::put('message', 'Add member successfully');
        return redirect()->route('register-member')->with('success', 'Member register successfully');
    }

    public function all_member()
    {
        $all_member = Member::paginate(10);
        $manage_member = view('admin.all_member')->with('all_member', $all_member);  // Hiển thị dữ liệu lên trang 'all_product'
        return view('admin_layout')->with('admin.all_member', $manage_member);
    }

    public function banMember($id)
    {
        $member = Member::findOrFail($id);
        $member->is_banned = true;    // cập nhật trạng thái ban
        $member->save();
        Session::put('message1', 'Ban member successfully');
        return Redirect()->back();
    }

    public function unbanMember($id)
    {
        $member = Member::findOrFail($id);
        $member->is_banned = false;    // cập nhật trạng thái ban
        $member->save();
        Session::put('message', 'Unban member successfully');
        return Redirect()->back();
    }

    public function search(Request $request)
    {
        // Lấy danh sách sản phẩm
        $all_member = Member::where('name', 'like', '%' . $request->key . '%')->orWhere('phone', $request->key)->paginate(10);;

        // Trả về view hiển thị sản phẩm sau khi lọc
        return view('admin.all_member', ['all_member' => $all_member->isEmpty() ? null : $all_member]);
    }
}
