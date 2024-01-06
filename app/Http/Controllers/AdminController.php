<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    // Hàm check login
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id == true) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin_login')->send();
        }
    }

    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $this->AuthLogin();           // Nếu login thì trả về trang showDashboard
        return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first(); // first() : lấy giới hạn 1 user
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // return view('admin.dashboard');


        // KIỂM TẢ DỮ LIỆU CÓ ĐÚNG VỚI DATABASE
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);

            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Invalid Email or Password ! Try again.');
            return Redirect::to('/admin_login');
        }
    }

    // HÀM XỬ LÝ LOG_OUT
    public function logout(Request $request)
    {
        $this->AuthLogin();           // Nếu login thì trả về trang logout
        Session::put('admin_name', null);
        Session::put('admin_id', null);

        return Redirect::to('/admin_login');
    }
}
