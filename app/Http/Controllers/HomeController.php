<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class HomeController extends Controller
{

    public function index()
    {
        // Hàm xử lý hiển thị slider
        $slider = Slider::orderBy("id", "DESC")->where('slider_status', '0')->take(4)->get();

        // Hàm xử lý hiển thị category product
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

        // Hàm xử lý hiển thị product
        $all_product = DB::table('product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(6)->get();

        // Hàm xử lý hiển thị category post
        $category_post = DB::table('category_posts')->where('category_posts_status', '0')->orderBy("category_posts_id", "DESC")->limit(1)->get();

        // Hàm xử lý hiển thị post
        $post = Post::with('cate_post')->where('post_status', '0')->orderBY('category_posts_id', 'DESC')->get();

        return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product)->with('slider', $slider)->with('category_post', $category_post)->with('post', $post);
    }

    public function product()
    {
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

        $all_product = DB::table('product')->where('product_status', '0')->where('product_quantity', '>', 0)->orderby('product_id', 'desc')->limit(4)->get();
        return view('pages.product')->with('category', $cate_product)->with('all_product', $all_product);
    }
}
