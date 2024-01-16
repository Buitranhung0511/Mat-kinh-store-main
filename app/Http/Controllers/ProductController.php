<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Rating as ModelsRating;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;


use App\Models\Rating;
use App\Models\Comment;

use file;

session_start();

class ProductController extends Controller
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


    public function add_product()
    {
        $this->AuthLogin();

        $cate_product = DB::table('category_product')->orderby('category_id', 'desc')->paginate(10);

        return view('admin.add_product')->with('cate_product', $cate_product);
    }

    public function all_product()
    {
        $this->AuthLogin();

        $all_product = DB::table('product')
            ->join('category_product', 'category_product.category_id', '=', 'product.category_id')
            ->orderBy('product.product_id', 'desc')->get();

        $manage_product = view('admin.all_product')->with('all_product', $all_product);  // Hiển thị dữ liệu lên trang 'all_product'
        return view('admin_layout')->with('admin.all_product', $manage_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        // phương thức sử lý xác thực các trường đăng ký có hợp lệ hay không..
        // $request->validate([
        //     'product_name' => 'required',
        //     'product_quantity' => 'required',
        //     'category_id' => 'required',
        //     'product_desc' => 'required',
        //     'product_content' => 'required',
        //     'product_price' => 'required',
        //     'product_image' => 'required',


        // ]);

        // Lấy CSDL
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;

        // Kiểm tra người dùng có muốn thay đổi tên anh hay không
        if ($request->has('product_image_name')) {
            $new_image = $request->input('product_image_name');
        } else {
            // Tạo tên file mới cho ảnh
            $get_image = $request->file('product_image');
            $name_image = $get_image->getClientOriginalName();
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        }

        // Lưu tên file ảnh vào CSDL
        $data['product_image'] = $new_image;
        $get_image->move('public/uploads/product', $new_image);   // đường  dẫn tới nơi lưu ảnh



        // Lưu sản phẩm vào CSDL
        DB::table('product')->insert($data);

        // Trả về thông báo
        Session::put('message', 'Add product successfully!');
        return Redirect::to('add-product');
    }

    // Hàm xử lý Show/Hiden
    public function unactive_product($product_id)
    {
        $this->AuthLogin();

        DB::table('product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message1', 'Deactivated product successfully');
        Log::info('Redirecting to all-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();

        DB::table('product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Activated product successfully');
        Log::info('Redirecting to all-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-product');
    }

    // Hàm xử lý Edit product
    public function edit_product($product_id)
    {
        $this->AuthLogin();

        $cate_product = DB::table('category_product')->orderby('category_id', 'desc')->get();

        $edit_product = DB::table('product')->where('product_id', $product_id)->get();

        $manage_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product);
        return view('admin_layout')->with('admin.edit_product', $manage_product);
    }

    // Hàm xử lý Update product , Sử dụng phương thức Request vì cần lấy yêu cầu dữ liệu
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();

        $data = array();

        $data['product_name'] = $request->product_name;


        // Kiểm tra input đầu vào tên có trùng lặp không
        $checkProductName = DB::table('product')
            ->where('product_name', $request->product_name)
            ->where('product_id', '!=', $product_id)
            ->exists();

        if ($checkProductName == true) {
            Session::put('message', '<h3 style="color:red;">Product_name already exits ? Please input again!</h3>');
            return Redirect()->back();
        } else {
            $data['product_name'] = $request->product_name;
        }

        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();             // Lấy tên ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    // Lấy đuôi mở rộng (jpeg , jpg,..)
            $get_image->move('public/uploads/product', $new_image);   // đường  dẫn tới nơi lưu ảnh
            $data['product_image'] = $new_image;
            DB::table('product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Update product successfully');
            return Redirect::to('all-product');
        }

        DB::table('product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Update product successfully');
        return Redirect::to('all-product');
    }

    // Hàm xử lý Delete product ,
    // Hàm xử lý Delete product ..
    public function delete_product($product_id)
    {
        $this->AuthLogin();

        DB::table('product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Delete category successfully');
        return Redirect::to('all-product');
    }
    // END ADMIN PAGE



    //PHAN CUA HƯNG
    public function detail_product($product_id)
    {
        $cate_product = DB::table('category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

        $detail_product = DB::table('product')
            ->where('product.product_id', $product_id)->get();

        foreach ($detail_product as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;

            // Fetch related products for each product
            $value->related_products = DB::table('product')
                ->join('category_product', 'category_product.category_id', '=', 'product.category_id')
                ->where('product.category_id', $category_id)
                ->where('product.product_id', '<>', $product_id)
                ->get();
        }
        $rating = rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
        return view('pages.product.show_detail')
            ->with('category', $cate_product)
            ->with('product_detail', $detail_product)
            ->with('rating', $rating);
    }

    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment  = Comment::where('product_id', $product_id)->where('comment_status', 0)->get();
       
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '<div class="row style_comment">
            <div class="col-md-2">
                <img width="50%" src="/frontend/images/batman_icon.png" class="img img-responsive img-thumbnail">
            </div>
            <div class="col-md-10">
                <p style="color: blue;">@' . $comm->comment_name . '</p>
                <p>' . $comm->comment . '</p>
            </div>

        </div>
        <p></p>';
        }
        echo $output;
    }

    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
       
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment_email = $request->comment_email;

        $comment = new Comment();
        $comment->comment_email = $comment_email;
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->product_id = $product_id;
        $comment->comment_status = 0;
        $comment->save();
    }

    //PHAN CUA HƯNG


    public function search_product(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_product = Product::where('product_name', 'like', '%' . $request->search_product . '%')->orWhere('product_price', $request->search_product)->paginate(10);

        // Trả về view hiển thị sau khi lọc
        return view('admin.all_product', ['all_product' => $all_product->isEmpty() ? null : $all_product]);
    }
}
