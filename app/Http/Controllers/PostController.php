<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Slider;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

session_start();

class PostController extends Controller
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


    public function add_post()
    {
        $this->AuthLogin();

        $cate_post = CategoryPost::orderby('category_posts_id', 'desc')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));
    }

    public function all_post()
    {
        $this->AuthLogin();

        $all_post = DB::table('posts')
            ->join('category_posts', 'category_posts.category_posts_id', '=', 'posts.category_posts_id')
            ->orderBy('posts.post_id', 'desc')->paginate(10);

        $manage_post = view('admin.post.all_post')->with('all_post', $all_post);  // Hiển thị dữ liệu lên trang 'all_post'
        return view('admin_layout')->with('admin.post.all_post', $manage_post);
    }

    public function save_post(Request $request)
    {
        $this->AuthLogin();

        // Lấy CSDL
        $data = array();

        // Kiểm tra đầu vào có trùng tên hay không
        // $checkProduct = DB::table('product')
        //     ->where('product_name', $request->product_name)
        //     ->where('product_id', $request->product_id)
        //     ->exists();

        // if ($checkProduct == true) {
        //     Session::put('message', '<h4 style="color:red;">Product_name already exits ? Please input again!</h4>');
        //     return Redirect()->back();
        // } else {
        // }
        $data['post_title'] = $request->post_title;
        $data['post_desc'] = $request->post_desc;
        $data['post_content'] = $request->post_content;
        $data['post_status'] = $request->post_status;
        $data['category_posts_id'] = $request->post_cate;
        $data['post_image'] = $request->post_image;

        // Kiểm tra người dùng có muốn thay đổi tên anh hay không
        if ($request->has('post_image_name')) {
            $new_image = $request->input('post_image_name');
        } else {
            // Tạo tên file mới cho ảnh
            $get_image = $request->file('post_image');
            $name_image = $get_image->getClientOriginalName();
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        }

        // Lưu tên file ảnh vào CSDL
        $data['post_image'] = $new_image;
        $get_image->move('public/uploads/product', $new_image);   // đường  dẫn tới nơi lưu ảnh



        // Lưu sản phẩm vào CSDL
        DB::table('posts')->insert($data);

        // Trả về thông báo
        Session::put('message', 'Add post successfully!');
        return Redirect::to('add-post');
    }

    // // Hàm xử lý Show/Hiden
    public function unactive_post($post_id)
    {
        $this->AuthLogin();

        DB::table('posts')->where('post_id', $post_id)->update(['post_status' => 1]);
        Session::put('message1', 'Deactivated post successfully');
        Log::info('Redirecting to all-post after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-post');
    }

    public function active_post($post_id)
    {
        $this->AuthLogin();

        DB::table('posts')->where('post_id', $post_id)->update(['post_status' => 0]);
        Session::put('message', 'Activated post successfully');
        Log::info('Redirecting to all-post after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-post');
    }

    // // Hàm xử lý Edit post
    public function edit_post($post_id)
    {
        $this->AuthLogin();

        $cate_post = DB::table('category_posts')->orderby('category_posts_id', 'desc')->get();

        $edit_post = DB::table('posts')->where('post_id', $post_id)->get();

        $manage_post = view('admin.post.edit_post')->with('edit_post', $edit_post)->with('cate_post', $cate_post);
        return view('admin_layout')->with('admin.post.edit_post', $manage_post);
    }

    // // Hàm xử lý Update product , Sử dụng phương thức Request vì cần lấy yêu cầu dữ liệu
    public function update_post(Request $request, $post_id)
    {
        $this->AuthLogin();

        $data = array();

        // $data['product_name'] = $request->product_name;

        // Kiểm tra input đầu vào tên có trùng lặp không
        $checkPostName = DB::table('posts')
            ->where('post_title', $request->product_name)
            ->where('post_id', '!=', $post_id)
            ->exists();

        if ($checkPostName == true) {
            Session::put('message', '<h4 style="color:red;">Post_title already exits ? Please input again!</h4>');
            return Redirect()->back();
        } else {
            $data['post_title'] = $request->post_title;
        }

        $data['category_posts_id'] = $request->cate_post_id;
        $data['post_desc'] = $request->post_desc;
        $data['post_desc'] = $request->post_desc;
        $data['post_content'] = $request->post_content;
        $data['post_status'] = $request->post_status;
        $get_image = $request->file('post_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();             // Lấy tên ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    // Lấy đuôi mở rộng (jpeg , jpg,..)
            $get_image->move('public/uploads/product', $new_image);   // đường  dẫn tới nơi lưu ảnh
            $data['post_image'] = $new_image;
            DB::table('posts')->where('post_id', $post_id)->update($data);
            Session::put('message', 'Update post successfully');
            return Redirect::to('all-post');
        }

        DB::table('posts')->where('post_id', $post_id)->update($data);
        Session::put('message', 'Update post successfully');
        return Redirect::to('all-post');
    }

    // Hàm xử lý Delete post ..
    public function delete_post($post_id)
    {
        $this->AuthLogin();

        DB::table('posts')->where('post_id', $post_id)->delete();
        Session::put('message', 'Delete post successfully');
        return Redirect::to('all-post');
    }

    public function search_post(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_post = Post::where('post_title', 'like', '%' . $request->search_post . '%')->paginate(10);

        // Trả về view hiển thị sau khi lọc
        return view('admin.post.all_post', ['all_post' => $all_post->isEmpty() ? null : $all_post]);
    }

    //=====================================================================================================================================
    // HIỂN THỊ TRANG HOME

    // public function category_post()
    // {

    //     // Hàm xử lý hiển thị slider
    //     $slider = Slider::orderBy("id", "DESC")->where('slider_status', '0')->limit(4)->get();

    //     // Hàm xử lý hiển thị category product
    //     $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

    //     // Hàm xử lý hiển thị product
    //     $all_product = DB::table('product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(6)->get();

    //     // Hàm xử lý hiển thị category post
    //     $category_post = CategoryPost::orderBy("category_posts_id", "DESC")->take(1)->get();

    //     foreach ($category_post as $key => $catepost) {
    //         $catepost->category_post_name;
    //         $catepost->category_posts_desc;
    //         $cate_id = $catepost->category_posts_id;
    //     };

    //     // Hàm xử lý hiển thị Post
    //     $post = Post::with('cate_post')->where('post_status', '0')->where('category_posts_id', $cate_id)->paginate(10);

    //     return view("pages.post_home.category_post")->with('cate_product', $cate_product)->with('all_product', $all_product)->with('slider', $slider)->with('category_post', $category_post)->with('post', $post);
    // }


}
