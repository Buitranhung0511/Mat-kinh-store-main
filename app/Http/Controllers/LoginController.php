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

        // Validate dữ liệu
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
            'customer_name.required' => 'Vui lòng nhập tên của bạn.',
            'customer_email.required' => 'Vui lòng nhập địa chỉ email của bạn.',
            'customer_email.email' => 'Địa chỉ email không hợp lệ.',
            'customer_email.unique' => 'Email đã tồn tại. Vui lòng sử dụng email khác.',
            'customer_password.required' => 'Vui lòng nhập mật khẩu.',
            'customer_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'customer_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'customer_address.required' => 'Vui lòng nhập địa chỉ của bạn.',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại của bạn.',
            'customer_gender.required' => 'Vui lòng chọn giới tính của bạn.',
            'customer_dob.required' => 'Vui lòng chọn ngày sinh của bạn.',
            'customer_dob.date' => 'Ngày sinh không hợp lệ.',
        ]);

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $existingCustomer = UserProfile::where('customer_email', $request->customer_email)->first();

        // Nếu email đã tồn tại, trả về thông báo lỗi
        if ($existingCustomer) {
            return redirect('/register')->with('error', 'Email đã tồn tại. Vui lòng sử dụng email khác.');
        }
        // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu chưa
        $existingCustomerPhone = UserProfile::where('customer_phone', $request->customer_phone)->first();

        // Nếu số điện thoại đã tồn tại, trả về thông báo lỗi
        if ($existingCustomerPhone) {
            return redirect('/register')->with('error', 'Số điện thoại đã tồn tại. Vui lòng sử dụng số điện thoại khác.');
        }
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_address'] = $request->customer_address;
        $data['customer_gender'] = $request->customer_gender; // Lấy giá trị giới tính từ yêu cầu
        $data['customer_dob'] = $request->customer_dob;
        $customer_id = DB::table('customers')->insertGetId($data);

        // Lưu thông tin đăng nhập vào session
        session::put('customer_id', $customer_id);
        session::put('customer_name', $request->customer_name);
        session::put('customer_phone', $request->customer_phone);
        session::put('customer_email', $request->customer_email);
        session::put('customer_address', $request->customer_address);
        session::put('customer_gender', $request->customer_gender);
        session::put('customer_dob', $request->customer_dob);


        Session::flash('success', 'Xin Chào,Chúc Mừng Bạn Đã Đăng ký thành công!');
        return Redirect('/profile');
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
                return redirect('/login')->with('message', 'Sai mật khẩu');
            }
        } else {
            // Người dùng không tồn tại
            return redirect('/login')->with('message', 'Không tìm thấy người dùng');
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
            return redirect('forgot-password')->with('ok', 'mật khẫu đã cập nhật, quay lại trang đăng nhập');
        } else {
            return redirect('forgot-password')->with('fail', 'Vui lòng nhập email vì link quá hạn');
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
                return redirect()->back()->with('loi', 'Emmail chưa đăng ký ');
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
            return redirect()->back()->with('win', "Gửi email thành công vào email để reset pass");
        }
    }
}
