<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\UserProfile;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
    //=============Dang Ky Auth=============





    //=============Dang Nhap Auth=============
    public function login_auth()
    {
        return view('admin.custom-Auth.login_auth');
    }


    //=============Dang Nhap Auth=============

    //=============Dang Xuat Auth=============
    public function logout_auth()
    {
        Auth::logout();
        return redirect('/login-auth')->with('message', 'Đăng Xuất Thành Công');
    }

    //=============Dang Xuat Auth=============


    public function login(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'
        ]);

        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('users')->where('email', $admin_email)->first();

        if ($result) {
            // You can pass the user data to the view
            return view('pages.test', ['user' => $result]);
        } else {
            return redirect('/login-auth')->with('message', 'Lỗi Đăng Nhập');
        }
    }
    /////////////////////// đổi pass user
    public function showChangePasswordForm()
    {
        return view('pages.login.change-password');
    }

    public function changePassword1(Request $request)
    {
        // Validate input kiểm tra giá trị đầu vào của password
        $request->validate([
            'customer_email' => 'required|email', // điều kiện
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Retrieve user by email
        $user = UserProfile::where('customer_email', $request->input('customer_email'))->first();
        // dd($user);
        // Check if the user exists and if the current password is correct
        if ($user && md5($request->input('current_password')) === $user->customer_password) {
            // Cập nhật mật khẩu mới với Bcrypt
            $user->customer_password = md5($request->input('new_password'));

            $user->save();

            return redirect()->route('profile')->with('success', 'Your password has been changed successfully!');
        } else {
            return redirect()->route('change-password1')->with('status', 'Cannot change password. Please check your current password.');
        }
    }
}
