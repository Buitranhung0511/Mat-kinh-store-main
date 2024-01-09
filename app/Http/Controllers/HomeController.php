<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;



use App\Models\Slider;

class HomeController extends Controller
{

    public function index()
    {
        $cate_product = DB::table('category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

        // $all_product = DB::table('product')
        // ->join('category_product', 'category_product.category_id', '=', 'product.category_id')
        // ->orderBy('product.product_id', 'desc')->get();
//123
        $all_product = DB::table('product')->get();
        return view('pages.home')->with('all_product',$all_product);;
    
     
    

        //slide
        $slider = Slider::orderBy('id', 'DESC')->where('slider_status', '0')->take(3)->get();

        //category
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

        //c
        //     ->join('category_product', 'category_product.category_id', '=', 'product.category_id')
        //     ->orderBy('product.product_id', 'desc')->get();..

        $all_product = DB::table('product')->where('product_status', '0')->orderBy('product_id', 'desc')->limit(3)->get();

        return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product)->with('slider', $slider);
    }
}