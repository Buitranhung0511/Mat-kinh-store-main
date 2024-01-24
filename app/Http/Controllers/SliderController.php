<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    // Hàm check login..
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id == true) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function manage_slider()
    {
        $this->AuthLogin();

        $all_slide = Slider::orderBy('id', 'DESC')->paginate(10);
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }

    public function add_slider()
    {
        return view('admin.slider.add_slider');
    }

    public function insert_slider(Request $request)
    {
        $this->AuthLogin();

        $data = $request->all();

        //1. user có ảnh
        $get_image = $request->file('slider_image');

        //2. nếu chọn ảnh, up lên từ đâu đó
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();             // Lấy tên ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    // Lấy đuôi mở rộng (jpeg , jpg,..)
            $get_image->move('public/uploads/slider', $new_image);   // đường  dẫn tới nơi lưu ảnh

            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();

            Session::put('message', 'Add slider successfully');
            return Redirect::to('add-slider');
        } else {
            Session::put('message', 'Please add image');
            return Redirect::to('add-slider');
        }


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


    }

    // Hàm xử lý Show/Hiden
    public function unactive_slide($id)
    {
        $this->AuthLogin();

        DB::table('slider')->where('id', $id)->update(['slider_status' => 1]);
        Session::put('message1', 'Deactivated slide successfully');
        Log::info('Redirecting to list-slider after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('manage-slider');
    }

    public function active_slide($id)
    {
        $this->AuthLogin();

        DB::table('slider')->where('id', $id)->update(['slider_status' => 0]);
        Session::put('message', 'Activated slide successfully');
        Log::info('Redirecting to list-slider  after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('manage-slider');
    }

    // Hàm xử lý Delete product ,
    public function delete_slide($id)
    {
        $this->AuthLogin();

        DB::table('slider')->where('id', $id)->delete();
        Session::put('message', 'Delete slide successfully');
        return Redirect::to('manage-slider');
    }

    public function search_slider(Request $request)
    {
        // Lấy dữ liệu danh sách
        $all_slide = Slider::where('slider_name', 'like', '%' . $request->search_slider . '%')->paginate(10);

        // Hiển thị danh sách sau khi lọc
        return view('admin.slider.list_slider', ['all_slide' => $all_slide->isEmpty() ? null : $all_slide]);
    }
}