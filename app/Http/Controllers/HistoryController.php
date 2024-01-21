<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\StatirticModel;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $orderId = $request->order;
        $order = Order::where('id', $orderId)->first();
        $orderDetails = OrderDetail::where('order_id', $orderId)->get();
        return view('Checkout.Thank', compact('order', 'orderDetails'));
    }



    public function updateStatistics()
    {
        try {
            $todayDate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $orders = Order::all();
            $totalSales = 0;
            $totalProfit = 0;
            $totalDiscount = 0;
            $totalQuantity = 0; // Initialize total quantity
            $totalOrders = count($orders);

            foreach ($orders as $order) {
                $totalSales += $order->total_amount;
                $totalDiscount += $order->total_discount;
                $totalQuantity += $order->quantity;
            }
            $totalProfit = $totalSales - $totalDiscount;
            $statisticalRecord = StatirticModel::where('order_date', $todayDate)->first();

            if ($statisticalRecord) {
                $statisticalRecord->update([
                    'sales' => $totalSales,
                    'profit' => $totalProfit,
                    'total_order' => $totalOrders,
                    'quantity' => $totalQuantity
                ]);
            } else {
                StatirticModel::create([
                    'order_date' => $todayDate,
                    'sales' => $totalSales,
                    'profit' => $totalProfit,
                    'total_order' => $totalOrders,
                    'quantity' => $totalQuantity
                ]);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây, ví dụ: log lỗi
            Log::error('Error in updateStatistics: ' . $e->getMessage());
        }
    }



    public function saveOrder($data)
    {


        //code...
        $address = session()->get('address');
        //getdata carts
        $carts = session()->get('cart');
        //dícount
        $discount = session()->get('discount');

        //xét giá trị cart
        $totalPrice = 0;
        $totalQuantity = 0;
        $productNames = [];


        foreach ($carts as $cart) {

            $productNames[] = $cart['name'];
            $totalQuantity += $cart['quantity'];
            $totalPrice += $cart['price'];
        }
        $totalDiscount  =   $totalPrice * ($discount[0]['counbon_percent'] / 100);
        $today = Carbon::now(); // Lấy ngày hiện tại
        $expectedDeliveryDate = $today->addDays(3)->format('Y-m-d'); // Cộng thêm 3 ngày

        $order = new Order([
            'customer_name' => $address['fullname'], // Cập nhật từ thông tin khách hàng
            'email' => $address['email'], // Cập nhật từ thông tin khách hàng
            'phone_number' => $address['phone'], // Cập nhật từ thông tin khách hàng
            'product_name' => implode(", ", $productNames), // Cập nhật từ thông tin sản phẩm
            'quantity' => $totalQuantity, // Cập nhật từ thông tin sản phẩm

            'total_amount' => $data['amount'], // Tính toán từ giỏ hàng
            'shipping_address' => json_encode([
                'address' => $address['address'],
                'city' => $address['city'],
                'district' => $address['district'],
                'ward' => $address['ward'],
                // Other necessary fields
            ], JSON_UNESCAPED_UNICODE),
            'shipping_method' => 'Grad', // Cập nhật từ thông tin vận chuyển
            'expected_delivery_date' => $expectedDeliveryDate, // Cập nhật từ thông tin vận chuyển
            'payment_method' => $data['orderType'], // Cập nhật từ thông tin thanh toán
            'payment_status' =>  $data['orderInfo'], // Cập nhật từ quy trình thanh toán
            'order_status' => 'Pending', // Cập nhật từ trạng thái mặc định hoặc quy trình xử lý
            'additional_notes' => 'Ghi chú thêm', // Nếu có
            'discount_code' =>  $discount[0]['counbon_code'], // Nếu áp dụng
            'total_discount' => $totalDiscount,
            'tax_amount' => '20', // Tính toán nếu cần
            'user_account_id' => isset($address['user_account_id']) ?? 0, // Nếu có liên kết với người dùng
            'refund_status' => 'cancel', // Nếu áp dụng
            'refund_notes' => 'Ghi chú hoàn tiền', // Nếu áp dụng
        ]);
        $order->save();

        // Lấy id của Order đã lưu
        $orderId = $order->id;
        session(['orderId' => $order->id]);
        foreach ($carts as $id => $cart) {
            $orderDetail = new OrderDetail([
                'order_id' => $orderId,
                'product_name' => $cart['name'],
                'product_id' => $id,
                'quantity' => $cart['quantity'],
                'product_price' => $cart['price'],
            ]);
            $product = Product::find($id);
            if ($product) {
                $product->product_quantity -= $cart['quantity'];
                $product->save();
            } else {
                dd('không tìm tháy product');
            }
            $orderDetail->save();
        }

        //get  address

        // Xóa thông tin địa chỉ và giỏ hàng khỏi session sau khi đã sử dụng
        session()->forget('address');
        session()->forget('cart');
        session()->forget('discount');
    }
    public function insertPaymentVnMomo(Request $request)
    {
        $data = $request->all();
        $data_momo = [
            'partnerCode'   => $data['partnerCode'],
            'accessKey'     => $data['accessKey'],
            'requestId'     => $data['requestId'],
            'amount'        => $data['amount'],
            'orderId'       => $data['orderId'],
            'orderInfo'     => $data['orderInfo'],
            'orderType'     => $data['orderType'],
            'transId'       => $data['transId'],
            'localMessage'  => $data['localMessage'],
            'responseTime'  => $data['responseTime'],
            'payType'       => $data['payType'],
            'signature'     => $data['signature'],
        ];
        $this->saveOrder($data_momo);


        if (isset($data['errorCode']) && $data['errorCode'] == 0) {
            // Tạo dữ liệu Payment
            $payment = Payment::create($data_momo);




            // Tạo đơn hàng nếu Payment được tạo thành công

            $orderId = session('orderId');
            // Truy xuất đơn hàng và chi tiết của nó
            $order = Order::find($orderId);

            if ($order) {
                // Nếu order được tạo thành công, gọi updateStatistics
                $this->updateStatistics();


                // Chuyển hướng đến trang cảm ơn
                return redirect()->route('thank', ['order' => $order]);
            } else {
                // Ghi log lỗi
                Log::error('Không thể tạo đơn hàng', ['data' => $data_momo]);
            }
        } else {
            // Ghi log lỗi khi có mã lỗi
            Log::error('Lỗi trong dữ liệu thanh toán', ['data' => $data_momo]);
        }

        // Xử lý trường hợp không thể tạo đơn hàng hoặc Payment không thành công
        // Ví dụ: trả về một thông báo lỗi
        return response()->json(['error' => 'Không thể xử lý đơn hàng'], 500);
    }
    public function insertPaymentVNpay(Request $request)
    {
        $data = $request->all();
        $data_vnpay = [
            'partnerCode'   => $data['vnp_TmnCode'],
            'accessKey'     => $data['vnp_TxnRef'],
            'requestId'     => $data['vnp_BankTranNo'],
            'amount'        => $data['vnp_Amount'],
            'orderId'       => $data['vnp_TmnCode'],
            'orderInfo'     => $data['vnp_OrderInfo'],
            'orderType'     => $data['vnp_CardType'],
            'transId'       =>  strval($data['vnp_TransactionNo']),
            'localMessage'  => $data['vnp_TransactionStatus'],
            'responseTime'  => $data['vnp_PayDate'],
            'payType'       => $data['vnp_BankCode'],
            'signature'     => $data['vnp_SecureHash']
        ];

        try {
            $data = $request->all();
            $data_vnpay = [
                'partnerCode'   => $data['vnp_TmnCode'],
                'accessKey'     => $data['vnp_TxnRef'],
                'requestId'     => $data['vnp_BankTranNo'],
                'amount'        => $data['vnp_Amount'],
                'orderId'       => $data['vnp_TmnCode'],
                'orderInfo'     => $data['vnp_OrderInfo'],
                'orderType'     => $data['vnp_CardType'],
                'transId'       =>  strval($data['vnp_TransactionNo']),
                'localMessage'  => $data['vnp_TransactionStatus'],
                'responseTime'  => $data['vnp_PayDate'],
                'payType'       => $data['vnp_BankCode'],
                'signature'     => $data['vnp_SecureHash']
            ];

            // Validate input data
            $this->validate($request, [
                'vnp_TmnCode'         => 'required',
                'vnp_TxnRef'          => 'required',
                'vnp_BankTranNo'      => 'required',
                'vnp_Amount'          => 'required',
                'vnp_OrderInfo'       => 'required',
                'vnp_CardType'        => 'required',
                'vnp_TransactionNo'  => 'required',
                'vnp_TransactionStatus' => 'required',
                'vnp_PayDate'         => 'required',
                'vnp_BankCode'        => 'required',
                'vnp_SecureHash'      => 'required',
            ]);

            // Check if errorCode is set and equal to 0
            if (isset($data['vnp_TransactionStatus']) && $data['vnp_TransactionStatus'] == 0) {
                Payment::create($data_vnpay);

                $this->saveOrder($data_vnpay);




                return redirect()->route('thank');
            }
        } catch (\Exception $e) {
            // Xử lý các exception trong quá trình xử lý dữ liệu
            // Log lỗi, hoặc hiển thị thông báo lỗi cho người dùng
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
    public function getDataCheckOut(Request $request)
    {
        // Handle the POST request logic here


        $validatedData = $request->validate([

            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'district' => 'required',
            'city' => 'required',
            'ward' => 'required',
        ]);
        session()->put('address', [

            'city' => $validatedData['city'],
            'email' => $validatedData['email'],
            'fullname' => $validatedData['fullname'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'district' => $validatedData['district'],
            'ward' => $validatedData['ward'],
        ]);

        // Perform database operations, validation, etc.
        $address = session()->get('address');

        return response()->json(['message' => 'Request processed successfully', 'code' => 200, compact('address')], 200);
    }
}
