<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\StatirticModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

  session_start();

class AdminController extends Controller
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
    //=========================HUNG============================

    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
         $this->AuthLogin();           // Nếu login thì trả về trang showDashboard

        $orders = DB::table('orders')->get();


        $totalStock = DB::table('product')->sum('product_quantity');
        // tính tổng sản lượng product bán theo tháng
        $soldThisMonth = DB::table('orders')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('quantity');
        //    best sale in month

        $bestSellingProduct = DB::table('orders')
            ->join('product', 'orders.product_id', '=', 'products.id')
            ->select('product.product_id', 'product.product_content', DB::raw('SUM(orders.quantity) as total_quantity'))
            ->whereMonth('orders.created_at', Carbon::now()->month)
            ->whereYear('orders.created_at',  Carbon::now()->year)
            ->groupBy('products.product_id', 'products.product.product_content')
            ->orderBy('total_quantity', 'desc');
        // ->first(); //
        //chart larvel
        $stockProducts = $totalStock - $soldThisMonth;

        return view('admin.showDataOrder', compact('bestSellingProduct', 'stockProducts', 'soldThisMonth'));
    }

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        // first() : lấy giới hạn 1 user
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
       return view('admin.dashboard');



        // KIỂM TẢ DỮ LIỆU CÓ ĐÚNG VỚI DATABASE
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            // Tạo biểu đồ



            //  return view('admin.dashboard');


            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Invalid Email or Password ! Try again.');
            return Redirect::to('/admin_login');
        }
    }

    // HÀM XỬ LÝ LOG_OUT
  
    public function logout(Request $request)
    {
        $this->AuthLogin();           // Nếu login thì trả về trang logout CUA HUNG
        Session::put('admin_name', null);
        Session::put('admin_id', null);

        return Redirect::to('/admin_login');
    }

    // /cap  nhat trang thai order
    public function updateOrderStatus(Request $request)
    {
        $orderId = $request->input('orderId');
        $status = $request->input('status');

        // Retrieve the order
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Update the order status
        $order->order_status = $status;
        $order->save();

        return response()->json(['success' => true]);
    }
    public function filterBydate(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $statistics = StatirticModel::whereBetween('order_date', [$from_date, $to_date])
            ->orderBy('order_date', 'ASC')
            ->get();

        $chart_data = [];
        foreach ($statistics as $value) {
            $chart_data[] = array(
                'perifod' => $value->order_date,
                'order' => $value->total_order,
                'profit' => $value->profit,
                'sales' => $value->sales,
                'quantity' => $value->quantity,
            );
        }

        // Explicitly setting the HTTP status code to 200
        return response()->json($chart_data, 200);
    }
}
