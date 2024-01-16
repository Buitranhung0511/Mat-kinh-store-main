<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index(){

        return view('Checkout.CheckOut');
    }
    public function vn_payment(Request $request){
      
              $data = $request->all();
        $code_cart = rand(00,9999);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
         $vnp_Returnurl = "http://127.0.0.1:8000/thank_vn_pay";
         $vnp_TmnCode = "ZEK1BB6X";//Mã website tại VNPAY 
        $vnp_HashSecret = "JIGBSCJQRQAGKGPPMDHNXCZAQHZSAUHV"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'thanh toan don hang  test';
        $vnp_OrderType = 'billpament';
        $vnp_Amount = $data['vn_payment'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        
        
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
          
            
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        
    }


    // momo
 public   function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
    public function vn_momo(Request $request){
         $data = $request->all();
      $total =  ($data['vn_momo']);
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    

$partnerCode = 'MOMOBKUN20180529';

$accessKey = 'klm05TvNBzhg7h7j';

$serectkey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

$orderInfo = "Thanh toán qua MoMo";
$amount = (string)(($total));
$orderid = time() . "";
$requestId = time(). "";
$returnUrl = "http://127.0.0.1:8000/thank_vn_momo";
$notifyurl = "http://127.0.0.1:8000/check_out";
// Lưu ý: link notifyUrl không phải là dạng localhost
$bankCode = "SML";
$requestType = "payWithMoMoATM";
 $extraData = "";

         //before sign HMAC SHA256 signature
         $rawHashArr =  array(
                        'partnerCode' => $partnerCode,
                        'accessKey' => $accessKey,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderid,
                        'orderInfo' => $orderInfo,
                        'bankCode' => $bankCode,
                        'returnUrl' => $returnUrl,
                        'notifyUrl' => $notifyurl,
                        'extraData' => $extraData,
                        'requestType' => $requestType
                        );
         // echo $serectkey;die;
         $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderid."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
         $signature = hash_hmac("sha256", $rawHash, $serectkey);

         $data =  array('partnerCode' => $partnerCode,
                        'accessKey' => $accessKey,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderid,
                        'orderInfo' => $orderInfo,
                        'returnUrl' => $returnUrl,
                        'bankCode' => $bankCode,
                        'notifyUrl' => $notifyurl,
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature);
         $result =  $this -> execPostRequest($endpoint, json_encode($data));
         $jsonResult = json_decode($result, true);

         if ($jsonResult !== null) {
            if (isset($jsonResult['payUrl'])) {
                header('Location: ' . $jsonResult['payUrl']);
                exit;
            } else {
                // Log the error and handle the case where 'payUrl' is not set
                $this->handleError("Error: 'payUrl' is not set in the API response.", $jsonResult);
            }
        } else {
            // Log the error and handle the case where json_decode failed
            $this->handleError("Error: Unable to decode JSON response.", $result);
        }
    }
    private function handleError($message, $data = null) {
        // Log the error message and additional data (if any)
        error_log($message);
        
        // Handle the error according to your application's requirements
        // For example, redirect to an error page, display an error message, etc.
        echo $message;
        if ($data !== null) {
            echo "<pre>" . print_r($data, true) . "</pre>";
        }
    }

    public function vn_onepay(Request $request){
        


$SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";



$data = $request->all();
$vpcURL = "https://mtf.onepay.vn/onecomm-pay/vpc.op" . "?";

$timestampString = '20230101120000';
$vn_onepay = isset($_POST['vn_onepay']) ? $_POST['vn_onepay'] : 0;
// Create a DateTime object from the string
$vpc_Merchant = 'ONEPAY';
$vpc_AccessCode = 'D67342C2';
$vpc_MerchTxnRef = time();

$vpc_OrderInfo = 'JSECURETEST01';
$vpc_Amount = $data['vn_onepay']*100;
$vpc_ReturnURL = 'http://127.0.0.1:8000/check_out';
$vpc_Version = '2';
$vpc_Command = 'pay';
$vpc_Locale ='vn';
$vpc_Currency = 'VND';
$data = array(
'vpc_Merchant'=>$vpc_Merchant,
'vpc_AccessCode'=>$vpc_AccessCode,
'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
'vpc_OrderInfo'=>$vpc_OrderInfo,
'vpc_Amount'=>$vpc_Amount,
'vpc_ReturnURL'=>$vpc_ReturnURL,
'vpc_Version'=>$vpc_Version,
'vpc_Command'=>$vpc_Command,
'vpc_Locale'=>$vpc_Locale,
'vpc_Currency'=>$vpc_Currency


);


$stringHashData = "";
// sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
// arrange array data a-z before make a hash
ksort ($data);

// set a parameter to show the first pair in the URL
// đặt tham số đếm = 0
$appendAmp = 0;

foreach($data as $key => $value) {

    // create the md5 input and URL leaving out any fields that have no value
    // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
    if (strlen($value) > 0) {
        // this ensures the first paramter of the URL is preceded by the '?' char
        if ($appendAmp == 0) {
            $vpcURL .= urlencode($key) . '=' . urlencode($value);
            $appendAmp = 1;
        } else {
            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
        if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		    $stringHashData .= $key . "=" . $value . "&";
		}
    }
}
//*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
$stringHashData = rtrim($stringHashData, "&");
// Create the secure hash and append it to the Virtual Payment Client Data if
// the merchant secret has been provided.
// thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
if (strlen($SECURE_SECRET) > 0) {
    //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
    // *****************************Thay hàm mã hóa dữ liệu*****************************
    $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
}

// FINISH TRANSACTION - Redirect the customers using the Digital Order
// ===================================================================
// chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
//header("Location: ".$vpcURL);

return redirect()->to($vpcURL);

// *******************
// END OF MAIN PROGRAM
// *******************


    }
}