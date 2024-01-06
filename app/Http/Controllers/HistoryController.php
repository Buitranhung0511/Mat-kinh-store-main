<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(){
        return view('Checkout.Thank');
    }
    public function saveOrder($data){


        try {
            //code...
            $address = session()->get('address');
            //getdata carts
            $carts = session()->get('cart');
          
            //xét giá trị cart
           
            $totalQuantity = 0;
            $productNames = [];
            foreach ($carts as $cart) {
               
                $productNames[] = $cart['name'];
                $totalQuantity += $cart['quantity'];
            }
            $today = Carbon::now(); // Lấy ngày hiện tại
        $expectedDeliveryDate = $today->addDays(3)->format('Y-m-d'); // Cộng thêm 3 ngày
            $order = new Order([
                'customer_name' =>$address['fullname'], // Cập nhật từ thông tin khách hàng
                'email' => $address['email'], // Cập nhật từ thông tin khách hàng
                'phone_number' => $address['phone'], // Cập nhật từ thông tin khách hàng
                'product_name' => implode(", ", $productNames), // Cập nhật từ thông tin sản phẩm
                'quantity' =>$totalQuantity, // Cập nhật từ thông tin sản phẩm
             
                'total_amount' =>$data['amount'], // Tính toán từ giỏ hàng
                'shipping_address' => json_encode([
                    'house' => $address['house'],
                    'city' => $address['city'],
                    'postalCode' => $address['postalCode'],
                    'zip' => $address['zip'],
                    // Các trường khác có thể cần thiết
                ]), // Đã lấy từ session
                'shipping_method' => 'Grad', // Cập nhật từ thông tin vận chuyển
                'expected_delivery_date' => $expectedDeliveryDate, // Cập nhật từ thông tin vận chuyển
                'payment_method' => $data['orderType'], // Cập nhật từ thông tin thanh toán
                'payment_status' =>  $data['orderInfo'], // Cập nhật từ quy trình thanh toán
                'order_status' => 'comfiml', // Cập nhật từ trạng thái mặc định hoặc quy trình xử lý
                'additional_notes' => 'Ghi chú thêm', // Nếu có
                'discount_code' => '10', // Nếu áp dụng
                'total_discount' => '10', // Nếu áp dụng
                'tax_amount' => '20', // Tính toán nếu cần
                'user_account_id' => isset($address['user_account_id']) ?? 0,// Nếu có liên kết với người dùng
                'refund_status' => 'cancel', // Nếu áp dụng
                'refund_notes' => 'Ghi chú hoàn tiền', // Nếu áp dụng
            ]);
            $order->save();

            // Lấy id của Order đã lưu
                $orderId = $order->id;
            foreach ($carts as $id => $cart) {
                $orderDetail = new OrderDetail([
                    'order_id' => $orderId,
                    'product_name'=>$cart['name'],
                    'product_id' => $id,
                    'quantity' => $cart['quantity'],
                    'product_price' => $cart['price'],
                ]);
                $product = Product::find($id);
                if ($product) {
                    $product->product_status -= $cart['quantity'];
                    $product->save();
                } else {
                    dd('không tìm tháy product');
                  
                }
                $orderDetail->save();
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        //get  address
       
         // Xóa thông tin địa chỉ và giỏ hàng khỏi session sau khi đã sử dụng
         session()->forget('address');
         session()->forget('cart');
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

    try {
        // Check if errorCode is set and equal to 0
        if (isset($data['errorCode']) && $data['errorCode'] == 0) {
            Payment::create($data_momo);
            $this->saveOrder($data_momo);

             return redirect()->route('thank');
        }
    } catch (\Exception $e) {
        // Handle the exception (e.g., log an error)
        \Log::error($e->getMessage());
        return response()->json(['message' => 'Error processing payment'], 400);
    }
}
public function insertPaymentVNpay(Request $request){
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
        // Check if errorCode is set and equal to 0
        if (isset($data['vnp_TransactionStatus']) && $data['vnp_TransactionStatus'] == 0) {
            Payment::create($data_vnpay);

            $this->saveOrder($data_vnpay);

             return redirect()->route('thank');
        }
    } catch (\Exception $e) {
        // Handle the exception (e.g., log an error)
        \Log::error($e->getMessage());
        return response()->json(['message' => 'Error processing payment'], 400);
    }
}
     public function getDataCheckOut(Request $request){
        // Handle the POST request logic here
  

        $validatedData = $request->validate([
            
            'city' => 'required',
            'email' => 'required|email',
            'fullname' => 'required',
            'house' => 'required',
            'phone' => 'required',
            'postalCode' => 'required',
            'zip' => 'required',
        ]);
        session()->put('address', [
                      
            'city' => $validatedData['city'],
            'email' => $validatedData['email'],
            'fullname' => $validatedData['fullname'],
            'house' => $validatedData['house'],
            'phone' => $validatedData['phone'],
            'postalCode' => $validatedData['postalCode'],
            'zip' => $validatedData['zip'],
        ]);
    
        // Perform database operations, validation, etc.
        $address = session()->get('address');
        return response()->json(['message' => 'Request processed successfully','code'=>200,compact('address')],200);
     }

  
}