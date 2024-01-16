<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends Controller
{
    public function view_order()
    {
        $all_order = Order::paginate(5);    // lấy tất cả đơn hàng từ DB..
        return view("admin.view_order", ['all_order' => $all_order]);
    }
}
