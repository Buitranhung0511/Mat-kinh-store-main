<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function index()
    {
        $products = DB::select('SELECT * FROM product');
        return view(' client.Products', ['products' => $products]);
    }
    private function getTotalCartQuantity()
    {
        $totalQuantity = 0;
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }
        return $totalQuantity;
    }
    public function addToCard($id)
    {

        $product =  DB::table('product')->where('product_id', $id)->first();


        $cart = session()->get('cart');
        if (isset($cart[$id])) {

            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {


            $cart[$id] = [
                'name' => $product->product_name,
                'price' => $product->product_price,
                'img' => $product->product_image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $carts = session()->get('cart');
        return response()->json([
            'code' => 200,
            'message' => 'sussces',
            'data' => $carts,
            'totalQuantity' => $this->getTotalCartQuantity()
        ], 200);
    }
    public function showCart()
    {
        $carts = session()->get('cart');
        return view('client.Cart', compact('carts'));
    }

    public function upDateCart(Request $request)
    {


        if ($request->id && $request->quantity) {
            $carts = session()->get('cart', []);

            if (isset($carts[$request->id])) {
                // Product ID exists in the cart, just update the quantity
                $carts[$request->id]['quantity'] = $request->quantity;
            } else {
                // Product ID does not exist in the cart, fetch from DB and add to the cart
                $product = DB::table('product')->where('product_id', $request->id)->first();

                // Assuming you want to add the product to the cart with the requested quantity
                if ($product) {
                    $carts[$request->id] = [
                        'quantity' => $request->quantity,
                        // Add other product details you might need in the cart, e.g. name, price
                        'name' => $product->product_name,
                        'price' => $product->product_price,
                        'img' => $product->product_image,
                    ];
                }
            }

            session()->put('cart', $carts);
            $cartComponent = view('client.CartComponent', compact('carts'))->render();

            return response()->json(
                [
                    'cart_Component' => $cartComponent,
                    'data' => $carts, 'code' => 200,
                    'totalQuantity' => $this->getTotalCartQuantity()
                ],
                200
            );
        }
    }
    public function deleteCartById(Request $request)
    {

        // Xác định sản phẩm cần xóa
        $carts = session('cart', []);
        $productToRemove = $request->id; // Chuyển đổi sang chuỗi nếu cần

        // Xóa sản phẩm khỏi mảng
        if (isset($carts[$productToRemove])) {
            unset($carts[$productToRemove]);
        }


        // Cập nhật lại giỏ hàng trong session
        session(['cart' => $carts]);

        // Render view với mảng cập nhật
        $cartComponent = view('client.CartComponent', compact('carts'))->render();

        return response()->json([
            'cart_Component' => $cartComponent,
            'data' => $carts, 'code' => 200,
            'totalQuantity' => $this->getTotalCartQuantity()
        ], 200);
    }
    public function getTotal()
    {
        $carts = session()->get('cart');
        return view('Checkout.CheckOut', compact('carts'));
    }
}
