<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Admin;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));
    }

    public function add_users()
    {
        return view('admin.users.add_users');
    }

    public function assign_roles(Request $request)
    {
        $data = $request->all();
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        $user->roles()->detach();

        if ($request['author_role']) {
            $user->roles()->attach(Roles::where('name', 'author')->first());
        }

        if ($request['user_role']) {
            $user->roles()->attach(Roles::where('name', 'user')->first());
        }

        if ($request['admin_role']) {
            $user->roles()->attach(Roles::where('name', 'admin')->first());
        }
        return redirect()->back()->with('messsage', 'Cap Quyen Thanh Cong');
    }

    // xử lý phần update profile user
    // Hiển thị trang cập nhật
    public function showUpdateForm()
    {
        // Kiểm tra xem có người dùng đang đăng nhập không
        if (auth()->check()) {
            // Lấy thông tin người dùng từ cơ sở dữ liệu
            $user = UserProfile::find(auth()->user()->customer_id);

            if ($user) {
                // Nếu người dùng tồn tại, trả về view cập nhật thông tin
                return view('pages.login.update', compact('user'));
            } else {
                // Nếu không tìm thấy thông tin người dùng, có thể xử lý thông báo lỗi ở đây
                return redirect()->back()->with('error', 'Không tìm thấy thông tin người dùng');
            }
        } else {
            // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
            return view('pages.login.update')->with('message', 'Bạn cần đăng nhập để cập nhật thông tin');
        }
    }

    // Xử lý cập nhật thông tin
    // Xử lý cập nhật thông tin
    public function update(Request $request)
    {
        // dd(session()->all()); // kiểm tra xem đã lưu vào sesion chưa
        // $user = Auth::user();
        // dd($user);  // Truy vấn người dùng hiện tại
        // // Kiểm tra xem session của người dùng có tồn tại không
        if (session()->has('customer_id')) {
            // Lấy ID của khách hàng từ session
            $customer_id = session('customer_id');
            //  dd($customer_id);
            // Tìm khách hàng trong cơ sở dữ liệu
            $customer = UserProfile::find($customer_id);

            // Kiểm tra xem khách hàng có tồn tại không
            if ($customer) {
                // Cập nhật thông tin của khách hàng
                $customer->customer_name = $request->input('customer_name');
                $customer->customer_phone = $request->input('customer_phone');
                $customer->customer_address = $request->input('customer_address');
                $customer->customer_gender = $request->input('customer_gender');
                $customer->customer_dob = $request->input('customer_dob');
                // Cập nhật các trường dữ liệu khác

                // Lưu các thay đổi vào cơ sở dữ liệu
                $customer->save();

                // Cập nhật session với thông tin mới
                session(['customer_name' => $customer->customer_name]);
                session(['customer_phone' => $customer->customer_phone]);
                session(['customer_address' => $customer->customer_address]);
                session(['customer_gender' => $customer->customer_gender]);
                session(['customer_dob' => $customer->customer_dob]);
                // Chuyển hướng người dùng đến trang hồ sơ và gửi thông báo thành công
                return redirect('/profile')->with('success', 'Thông tin của bạn đã được cập nhật thành công.');
            } else {
                // Xử lý trường hợp không tìm thấy khách hàng trong cơ sở dữ liệu
                return redirect('/login')->with('error', 'Không tìm thấy thông tin khách hàng. Vui lòng đăng nhập lại.');
            }
        } else {

            // Xử lý trường hợp session không tồn tại (hết hạn hoặc bị mất)
            return redirect('/login')->with('error', 'Phiên đăng nhập của bạn đã hết hạn hoặc bị mất. Vui lòng đăng nhập lại.');
        }
    }
}
