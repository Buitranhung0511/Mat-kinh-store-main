<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;



use App\Models\Slider;

class HomeController extends Controller
{

    public function index()
    {
        $cate_product = DB::table('category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

        $all_product = DB::table('product')->where('product_status','0')->orderby('product_id', 'desc')->limit(4)->get();
        return view('pages.home')->with('category',$cate_product)->with('all_product',$all_product);
    }

    public function product(){
        $cate_product = DB::table('category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

        $all_product = DB::table('product')->where('product_status','0')->orderby('product_id', 'desc')->limit(4)->get();
        return view('pages.product')->with('category',$cate_product)->with('all_product',$all_product);
        
    }
}
