<?php

namespace App\Http\Controllers;

use App\Models\Rating as ModelsRating;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\UserProfile;
use file;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use DateTime;

session_start();
class LoginController extends Controller
{
    public function login()
    {
        return view('pages.login.login');
    }
    public function register()
    {
        return view('pages.login.register');
    }
    public function add_customer(Request $request)
    {
        $token = Str::random(10);
        // Validate dữ liệu
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email|unique:customers',
            'customer_password' => 'required|string|min:6|confirmed',
            'customer_address' => 'required',
            'customer_phone' => 'required',
            'customer_gender' => 'required',
            'customer_dob' => 'required|date',
        ], [
            'customer_name.required' => 'Please enter your name.',
            'customer_email.required' => 'Please enter your email address.',
            'customer_email.email' => 'Invalid email address.',
            'customer_email.unique' => 'Email already exists. Please use another email.',
            'customer_password.required' => 'Please enter password.',
            'customer_password.min' => 'Password must have at least 6 characters.',
            'customer_password.confirmed' => 'Confirmed password does not match.',
            'customer_address.required' => 'Please enter your address.',
            'customer_phone.required' => 'Please enter your phone number.',
            'customer_gender.required' => 'Please select your gender.',
            'customer_dob.required' => 'Please select your date of birth.',
            'customer_dob.date' => 'Invalid date of birth.',
        ]);

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $existingCustomer = UserProfile::where('customer_email', $request->customer_email)->first();

        // Nếu email đã tồn tại, trả về thông báo lỗi
        if ($existingCustomer) {
            return redirect('/register')->with('error', 'Email already exists. Please use another email.');
        }

        // Kiểm tra độ tuổi
        $dob = new DateTime($request->customer_dob);
        $now = new DateTime();
        $age = $now->diff($dob)->y;

        // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu chưa
        $existingCustomerPhone = UserProfile::where('customer_phone', $request->customer_phone)->first();

        // Nếu số điện thoại đã tồn tại, trả về thông báo lỗi
        if ($existingCustomerPhone) {
            return redirect('/register')->with('error', 'Phone number already exists. Please use another phone number.');
        }
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_address'] = $request->customer_address;
        $data['customer_gender'] = $request->customer_gender; // Lấy giá trị giới tính từ yêu cầu
        $data['customer_dob'] = $request->customer_dob;
        $data['customer_token'] = $token; // Gán giá trị token
        $customer_id = DB::table('customers')->insertGetId($data);

        // Lưu thông tin đăng nhập vào session
        session::put('customer_id', $customer_id);
        session::put('customer_name', $request->customer_name);
        session::put('customer_phone', $request->customer_phone);
        session::put('customer_email', $request->customer_email);
        session::put('customer_address', $request->customer_address);
        session::put('customer_gender', $request->customer_gender);
        session::put('customer_dob', $request->customer_dob);

        Session::flash('success', 'Hello, Congratulations on your successful registration!');
        return Redirect('/profile');
    }
    public function showmenber()
    {
        $all_member = Userprofile::all();
        // $manage_member = view('admin.show_members')->with('show_members', $all_member);
        $manage_member = view('admin.show_members')->with('all_member', $all_member);
        return view('admin_layout')->with('admin.all_member', $manage_member);
    }
    public function ban_customer($customer_id)
    {
        $member = UserProfile::findOrFail($customer_id);
        $member->customer_ban = true;    // cập nhật trạng thái ban
        $member->save();
        Session::put('message2', 'Ban member successfully');
        return Redirect()->back();
    }

    public function uban_customer($customer_id)
    {
        $member = UserProfile::findOrFail($customer_id);
        $member->customer_ban = false;    // cập nhật trạng thái ban
        $member->save();
        Session::put('message3', 'Unban member successfully');
        return Redirect()->back();
    }

    public function search(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_member = UserProfile::where('customer_name', 'like', '%' . $request->seach . '%')->orWhere('customer_phone', $request->seach)->paginate(10);

        // Trả về view hiển thị sau khi lọc
        return view('admin.show_members', ['all_member' => $all_member->isEmpty() ? null : $all_member]);
    }
    public function logout()
    {
        session::flush();
        return Redirect('/login');
    }
    public function login_customer(Request $request)
    {
        $email = $request->email_accout;
        $password = $request->password_accout;
        //   dd($email);
        $user = UserProfile::where('customer_email', $email)->first();


        if ($user) {
            // dd($password);
            // Kiểm tra mật khẩu với phương thức mã hóa MD5
            if ($user->customer_password === md5($password)) {
                // Mật khẩu đúng

                session()->put('customer_id', $user->customer_id);
                session()->put('customer_name', $user->customer_name);
                session()->put('customer_email', $user->customer_email);
                session()->put('customer_phone', $user->customer_phone);
                session()->put('customer_address', $user->customer_address);
                session()->put('customer_gender', $user->customer_gender);
                session()->put('customer_dob', $user->customer_dob);
                // session()->put('customer_img', $user->customer_img);
                session()->flash('success1', 'Đăng nhập thành công.');
                return redirect('/');
            } else {
                // Mật khẩu không đúng
                return redirect('/login')->with('message', 'Wrong password');
            }
        } else {
            // Người dùng không tồn tại
            return redirect('/login')->with('message', 'User not found');
        }
    }
    public function profile()
    {
        return view('pages.login.profile');
    }
    public function updateAvatar(Request $request)
    {
        // $request->validate([
        //     'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
        // ]);

        // $user = UserProfile::findOrFail(auth()->id());

        // if ($request->hasFile('avatar')) {
        //     // Xóa hình ảnh cũ nếu có
        //     // code xử lý xóa hình ảnh cũ

        //     // Lưu trữ hình ảnh mới vào thư mục public/avatar
        //     $avatarPath = $request->file('customer_img')->store('public/customer_img');

        //     // Cập nhật đường dẫn hình ảnh mới vào cơ sở dữ liệu
        //     $user->avatar = $avatarPath;
        //     $user->save();

        //     return back()->with('success', 'Hình ảnh đã được cập nhật thành công');
        // } else {
        //     return back()->with('error', 'Không có hình ảnh được tải lên');
        // }

        // $data = array();

        // $get_image = $request->file('customer_img');

        // if ($request->has('customer_img_name')) {
        //     $new_image = $request->input('customer_img_name');
        // } else {
        //     // Tạo tên file mới cho ảnh
        //     $get_image = $request->file('customer_img');
        //     // $name_image = $get_image->getClientOriginalName();
        //     // $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        // }
        // $data['customer_img'] = $new_image;
        // $get_image->move('public/customer_img', $new_image);
        // DB::table('customers')->insert($data);
        // // Lưu tên file ảnh vào CSDL
        // // $data['customer_img'] = $new_image;
        // // $get_image->move('public/customer_img', $new_image);   // đường  dẫn tới nơi lưu ảnh
    }
    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */

    public function showpageforgotpass(Request $request)
    {
        return view('pages.login.forgot-password');
    }
    public function reset_new_pass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $customer = UserProfile::where('customer_email', '=', $data['email'])->where('customer_token', '=', $data['token'])->get();
        $count = $customer->count();
        if ($count > 0) {
            foreach ($customer as $key => $cus) {
                $customer_id = $cus->customer_id;
            }
            $reset = UserProfile::find($customer_id);
            $reset->customer_password = md5($data['password_accout']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('forgot-password')->with('ok', 'password updated, return to login page');
        } else {
            return redirect('forgot-password')->with('fail', 'Please enter your email because the link is expired');
        };
    }


    public function update_new_pass(Request $request)
    {
        return view('pages.login.new-pass');
    }
    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recover_pass(Request $request)

    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = "reset password";
        $customer = UserProfile::where('customer_email', '=', $data['email_accout'])->get();
        foreach ($customer as $key => $value) {
            $customer_id = $value->customer_id;
        }

        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return redirect()->back()->with('loi', 'Email is not registered');
            }
        } else {
            $token_random = Str::random();
            $customer = UserProfile::find($customer_id);
            $customer->customer_token = $token_random;
            $customer->save();
            // gửi email

            $to_email = $data['email_accout']; // gửi email này
            $link_reset_pass = url('update-new-pass?email=' . $to_email . '&token=' . $token_random);
            $data = array("name" => $title_email, "body" => $link_reset_pass, 'email' => $data['email_accout']);
            Mail::send('pages.login.forget_pass_notify', ['data' => $data], function ($message) use ($title_email, $data) {
                $message->to($data['email'])->subject($title_email); // send from this mail vs subject
                $message->form($data['email'], $title_email);
            });
            return redirect()->back()->with('win', "Successfully sent email to email to reset password");
        }
    }
}
