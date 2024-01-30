<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Slider;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CategoryPostController extends Controller
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

    public function add_category_post(Request $request)
    {
        $this->AuthLogin();           // Nếu login thì trả về trang add_category_product
        return view('admin.category_post.add_category_post');
    }

    public function all_category_post()
    {
        $this->AuthLogin();           // Nếu login thì trả về trang all_category_product
        $all_category_post = DB::table('category_posts')->paginate(10); // Lấy dữ liệu bảng category_product

        $manage_category_post = view('admin.category_post.all_category_post')->with('all_category_post', $all_category_post);  // Hiển thị dữ liệu lên trang 'all_category_product'
        return view('admin_layout')->with('admin.category_post.all_category_post', $manage_category_post);
    }

    public function save_category_post(Request $request)
    {
        $this->AuthLogin();           // Nếu login thì trả về trang save_category_post
        // Lấy CSDL
        $data = array();

        // Kiểm tra đầu vào có trùng tên hay không
        $checkCategoryPost = DB::table('category_posts')
            ->where('category_posts_name', $request->cate_post_name)
            ->where('category_posts_id', $request->category_posts_id)
            ->exists();

        if ($checkCategoryPost == true) {
            Session::put('message', '<h4 style="color:red;">Category_post_name already exits ? Please input again!</h4>');
            return Redirect()->back();
        } else {
            $data['category_posts_name'] = $request->cate_post_name;
        }

        $data['category_posts_desc'] = $request->cate_post_desc;
        $data['category_posts_status'] = $request->cate_post_status;

        DB::table('category_posts')->insert($data);
        Session::put('message', 'Add category post successfully');
        return Redirect::to('add-category-post');
    }

    // // Hàm xử lý Show/Hiden
    public function unactive_cate_post($category_posts_id)
    {
        $this->AuthLogin();
        DB::table('category_posts')->where('category_posts_id', $category_posts_id)->update(['category_posts_status' => 1]);
        Session::put('message1', 'Deactivated category post successfully');
        Log::info('Redirecting to all-category-post after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-category-post');
    }

    public function active_cate_post($category_posts_id)
    {
        $this->AuthLogin();
        DB::table('category_posts')->where('category_posts_id', $category_posts_id)->update(['category_posts_status' => 0]);
        Session::put('message1', 'Activated category post successfully');
        Log::info('Redirecting to all-category-post after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-category-post');
    }


    // // Hàm xử lý Edit cate_post
    public function edit_category_post($category_posts_id)
    {
        $this->AuthLogin();
        $edit_category_post = DB::table('category_posts')->where('category_posts_id', $category_posts_id)->get();

        $manage_category_post = view('admin.category_post.edit_category_post')->with('edit_category_post', $edit_category_post);
        return view('admin_layout')->with('admin.category_post.edit_category_post', $manage_category_post);
    }

    // // Hàm xử lý Update product , Sử dụng phương thức Request vì cần lấy yêu cầu dữ liệu
    public function update_category_post(Request $request, $category_posts_id)
    {
        $this->AuthLogin();
        $data = array();

        // Kiểm tra đầu vào có trùng tên hay không
        $checkCategoryPost = DB::table('category_posts')
            ->where("category_posts_name", $request->cate_post_name)
            ->where("category_posts_id", "!=", $category_posts_id)
            ->exists();

        if ($checkCategoryPost == true) {
            Session::put('message', '<h4 style="color:red;">Category_post_name already exits ? Please input again!</h4>');
            return Redirect()->back();
        } else {
            $data['category_posts_name'] = $request->cate_post_name;
        }

        $data['category_posts_desc'] = $request->cate_post_desc;
        DB::table('category_posts')->where('category_posts_id', $category_posts_id)->update($data);
        Session::put('message', 'Update category post successfully');
        return Redirect::to('all-category-post');
    }

    // Hàm xử lý Delete cate post ,
    public function delete_category_post($category_posts_id)
    {
        $this->AuthLogin();
        DB::table('category_posts')->where('category_posts_id', $category_posts_id)->delete();
        Session::put('message', 'Delete category post successfully');
        return Redirect::to('all-category-post');
    }

    public function search_cate_post(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_category_post = CategoryPost::where('category_posts_name', 'like', '%' . $request->search_cate_post . '%')->paginate(10);

        // Trả về view hiển thị sau khi lọc
        return view('admin.category_post.all_category_post', ['all_category_post' => $all_category_post->isEmpty() ? null : $all_category_post]);
    }

    // HIỂN THỊ TRANG HOME

    public function category_post(Request $request)
    {

        // Xử lý logic
        $category_post = CategoryPost::orderBy('category_posts_id', 'DESC')->get();

        // Kiểm tra nếu không có dữ liệu category_post thì chuyển hướng về trang chủ
        if ($category_post->isEmpty()) {
            return redirect()->route('home');
        }

        // Sử dụng first() thay vì foreach để lấy một record
        $catepost = $category_post->first();

        $meta_title = $catepost->category_posts_name;
        $meta_des = $catepost->category_posts_desc;
        $cate_id = $catepost->category_posts_id;
        $url_canonical = $request->url();

        // Sử dụng Eager Loading để tối ưu hóa truy vấn
        $post = Post::with('cate_post')->where('post_status', '0')->where('category_posts_id', $cate_id)->paginate(10);

        // Trả về view
        return view('pages.post_home.category_post', compact(
            'category_post',
            'post',
            'meta_title',
            'meta_des',
            'url_canonical',
            'cate_id'
        ));
    }

    // public function category_post(Request $request)
    // {
    //     // Xử lý lấy dữ liệu
    //     $slider = Slider::orderBy('id', 'DESC')->where('slider_status', '0')->limit(4)->get();
    //     $cate_product = CategoryProduct::where('category_status', '0')->orderBy('category_id', 'desc')->get();
    //     $all_product = Product::where('product_status', '0')->orderBy('product_id', 'desc')->limit(6)->get();

    //     // Xử lý logic
    //     $category_posts = CategoryPost::orderBy('category_posts_id', 'DESC')->get();

    //     // Kiểm tra nếu không có dữ liệu category_post thì chuyển hướng về trang chủ
    //     if ($category_posts->isEmpty()) {
    //         return redirect()->route('home');
    //     }

    //     // Lấy tất cả các danh mục và bài viết tương ứng
    //     $posts = [];
    //     foreach ($category_posts as $catepost) {
    //         $posts[$catepost->category_posts_id] = Post::with('cate_post')
    //             ->where('post_status', '0')
    //             ->where('category_posts_id', $catepost->category_posts_id)
    //             ->paginate(10);
    //     }

    //     // Trả về view
    //     return view('pages.post_home.category_post', compact(
    //         'slider',
    //         'cate_product',
    //         'all_product',
    //         'category_posts',
    //         'posts'
    //     ));
    // }
}
