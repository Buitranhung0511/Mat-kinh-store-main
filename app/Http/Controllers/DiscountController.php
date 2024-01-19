<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function add_discount()
    {
        return view('admin.add_discount');
    }

    public function save_discount(Request $request)
    {
        // Lấy CSDL
        $data = array();
        $data['discount_name'] = $request->discount_name;
        $data['discount_code'] = $request->discount_code;
        $data['discount_percent'] = $request->discount_percent;
        $data['discount_status'] = $request->discount_status;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';..

        DB::table('discounts')->insert($data);
        Session::put('message', 'Add discount successfully');
        return Redirect::to('all-discount');
    }


    public function all_discount()
    {
        $all_discount = DB::table('discounts')->paginate(10);
        $manage_discount = view('admin.all_discount')->with('all_discount', $all_discount);   // Hiển thị dữ liệu lên trang 'all_discount'
        return view('admin_layout')->with('admin.all_discount', $manage_discount);
    }

    // Hàm xử lý Show/Hiden
    public function unactive_discount($discount_id)
    {
        DB::table('discounts')->where('discount_id', $discount_id)->update(['discount_status' => 1]);
        Session::put('message1', 'Deactivated discount successfully');
        Log::info('Redirecting to all-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-discount');
    }

    public function active_discount($discount_id)
    {


        DB::table('discounts')->where('discount_id', $discount_id)->update(['discount_status' => 0]);
        Session::put('message1', 'Deactivated discount successfully');
        Log::info('Redirecting to all-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-discount');
    }

    public function search_discount(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_discount = Discount::where('discount_name', 'like', '%' . $request->search_discount . '%')->paginate(10);

        // Trả về view hiển thị sau khi lọc
        return view('admin.all_discount', ['all_discount' => $all_discount->isEmpty() ? null : $all_discount]);
    }

    public function edit_discount($discount_id)
    {
        $edit_discount = DB::table('discounts')->where('discount_id', $discount_id)->get();

        $manage_discount = view('admin.edit_discount')->with('edit_discount', $edit_discount);
        return view('admin_layout')->with('admin.edit_discount', $manage_discount);
    }

    public function update_discount(Request $request, $discount_id)
    {
        try {
            $discount = Discount::findOrFail($discount_id);

            // Kiểm tra giá trị của discount_percent từ request có tồn tại không
            $discountPercent = $request->input('discount_percent');
            if ($discountPercent !== null) {
                // Gán giá trị discount_percent từ request vào trường discount_percent
                $discount->discount_percent = $discountPercent;
                $discount->save();
            } else {
                // Nếu giá trị discount_percent là null, xử lý theo ý của bạn, ví dụ: thông báo lỗi hoặc xử lý khác
                return response()->json(['message' => 'Giá trị discount_percent không được để trống'], 400);
            }


            // Lấy lại thông tin discount sau khi đã được cập nhật
            $updatedDiscount = Discount::findOrFail($discount_id)->paginate(10);

            return Redirect::to('all-discount');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function delete_discount($discount_id)
    {
        DB::table('discounts')->where('discount_id', $discount_id)->delete();
        Session::put('message', 'Delete discount successfully !');
        return Redirect::to('all-discount');
    }
}
