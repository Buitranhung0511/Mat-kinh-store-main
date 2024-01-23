<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryProduct;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

session_start();

class CategoryProductController extends Controller
{
    // Hàm check login
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id == true) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product()
    {
         $this->AuthLogin();           // Nếu login thì trả về trang add_category_product
        return view('admin.add_category_product');
    }

    public function all_category_product()
    {
         $this->AuthLogin();           // Nếu login thì trả về trang all_category_product

        $all_category_product = DB::table('category_product')->get(); // Lấy dữ liệu bảng category_product

        $all_category_product = DB::table('category_product')->paginate(10); // Lấy dữ liệu bảng category_product

        $all_category_product = DB::table('category_product')->get(); // Lấy dữ liệu bảng category_product

        $manage_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);  // Hiển thị dữ liệu lên trang 'all_category_product'
        return view('admin_layout')->with('admin.all_category_product', $manage_category_product);
    }

    public function save_category_product(Request $request)
    {
         $this->AuthLogin();           // Nếu login thì trả về trang save_category_product
        // Lấy CSDL
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        // $data['product_quantity'] = $request->category_product_quantity;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        DB::table('category_product')->insert($data);
        Session::put('message', 'Add category successfully');
        return Redirect::to('add-category-product');

    }

    // Hàm xử lý Show/Hiden
    public function unactive_category_product($category_product_id)
    {
         $this->AuthLogin();
        DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message1', 'Deactivated category product successfully');
        Log::info('Redirecting to all-category-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id)
    {
         $this->AuthLogin();
        DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Activated category product successfully');
        Log::info('Redirecting to all-category-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-category-product');
    }

    // Hàm xử lý Edit product
    public function edit_category_product($category_product_id)
    {
 $this->AuthLogin();
        $edit_category_product = DB::table('category_product')->where('category_id', $category_product_id)->get();

        $manage_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manage_category_product);
    }

    // Hàm xử lý Update product , Sử dụng phương thức Request vì cần lấy yêu cầu dữ liệu
   

    public function update_category_product(Request $request, $category_id)
    {
 $this->AuthLogin();
        $data = array();

        // Kiểm tra đầu vào category có trùng lặp không

        $checkCategory = DB::table('category_product')
            ->where('category_name', $request->category_name)
            ->where('category_id', '!=', $category_id)
            ->exists();
        if ($checkCategory == true) {
            Session::put('message', '<h3 style="color:red;">Category_name already exits ? Please input again!</h3>');
            return Redirect()->back();
        } else {
            $data['category_name'] = $request->category_name;
        }

        $data['category_desc'] = $request->category_desc;
        DB::table('category_product')->where('category_id', $category_id)->update($data);
        Session::put('message', 'Update category successfully');
        return Redirect::to('all-category-product');
    
    }


    // Hàm xử lý Delete product ..
  

    // Hàm xử lý Delete product ,
    public function delete_category_product($category_product_id)
    {
 $this->AuthLogin();
        DB::table('category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Delete category successfully');
        return Redirect::to('all-category-product');
    }

    public function show_category_home($category_id){
        $cate_product = DB::table('category_product')->where('category_status','0')->orderby('category_id','desc')->get();


        $category_by_id = DB::table('product')->join('category_product','product.category_id','=','category_product.category_id')->where('product.category_id',$category_id)->get();
        $category_name = DB::table('category_product')->where('category_product.category_id',$category_id)->limit(1)->get();
        
     

 //  render product them ren
             $renderProduct = view('pages.category.show_category',
              compact('category_by_id','category_name'))->render();
                 return response()->json(
                    [
                      'data' =>$renderProduct,
                       'code' => 200,
                    ], 
                     200);
           
    }
    public function search_category_product(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_category_product = CategoryProduct::where('category_name', 'like', '%' . $request->search_category_product . '%')->paginate(10);
     

    
        // Trả về view hiển thị sau khi lọc
        return view('admin.all_category_product', ['all_category_product' => $all_category_product->isEmpty() ? null : $all_category_product]);
    }
}