<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_auth()
    {
        return view('admin.custom-Auth.register');
    }

    //=============Dang Ky Auth=============

    public function register(Request $request)
    {
        $this->validation($request);
        // sàu khi gởi qua hàm register rồi thì kiểm tra lại hàm validation tất cả và tất cả data của request
        $data = $request->all(); // nếu ok rồi thì lấy tất cả các data trên request

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect('/register-auth')->with('message', 'Đăng Ký thành công');
    }

    public function validation($request)
    {
        return $this->validate($request, [
            'admin_name' => 'required|max:255',
            'admin_phone' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'

        ]);
    }

    //=============Dang Nhap Auth=============
    public function login_auth()
    {
        return view('admin.custom-Auth.login_auth');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'
        ]);
        $data = $request->all(); // nếu ok rồi thì lấy tất cả các data trên request
        if (Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/login-auth')->with('message', 'Lỗi Đăng Nhập');
        }

        // if (Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password], true)) {
        //     return redirect('/dashboard');
        // } else {
        //     return redirect('/login-auth')->with('message', 'Lỗi Đăng Nhập');
        // }
    }

    //=============Dang Xuat Auth=============
    public function logout_auth()
    {
        Auth::logout();
        return redirect('/login-auth')->with('message', 'Đăng Xuất Thành Công');
    }

    //=============Dang Xuat Auth=============



}
