<section class="h-100 h-custom" style="background-color: #d2c9ff;">
    <div class="container py-5 h-100  update_cart_url" data-url="{{ route('updateCart') }}">
      <div class="row d-flex justify-content-center align-items-center h-100 delete_cart_url" data-url="{{ route('deleteCart') }}">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                      
                    </div>
                    
                        @php
                        $subTotal = 0  ;  
                        @endphp
                        @if(!is_null($carts) && is_array($carts) && count($carts) > 0)
                    @foreach ($carts as $id=>  $cart)
                        @php
                          $subTotal  += $cart['price']  * $cart['quantity'];
                        @endphp
                    <hr class="my-4">
                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img
                          src="{{ asset('public/uploads/product/'. $cart['img']) }}"
                          class="img-fluid rounded-3" alt="Cotton T-shirt"style="height: 150px; width: 150px;"/>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <h3 class="text-muted">{{ $cart['name'] }}</h3>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <button 
                        class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                         >
                          <i class="fas fa-minus"></i>
                        </button>
  
                        <input
                        id="{{ $id }}"
                        min="1"
                        name="quantity"
                        value="{{ $cart['quantity'] }}"
                        type="number"
                        class="form-control form-control-sm "
                      />
                      
  
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h3 class="mb-0">{{ $cart['price']  * $cart['quantity'] }}</h3>
                      </div>
                     
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a
                        data-id="{{$id}}"
                        class="text-muted cart-edit"
                       
                        >
                          <i class="fas fa-edit"></i></a>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a 
                        href="#!"
                        data-id="{{$id}}"
                        class="text-muted cart-delete">
                          <i class="fas fa-times"></i></a>
                      </div>
                      
                    </div>
                    @endforeach
  
  
  
  
                   
  
  
                  </div>
                </div>
                <div class="col-lg-4 bg-grey">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">
  
                    <div class="d-flex justify-content-between mb-4">
                      <h5 class="text-uppercase">items 3</h5>
                      <h5>€ 132.00</h5>
                    </div>
  
                    <h5 class="text-uppercase mb-3">Shipping</h5>
  
                    <div class="mb-4 pb-2">
                      <select class="select">
                        <option value="1">Standard-Delivery- €5.00</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                      </select>
                    </div>
  
                    <h5 class="text-uppercase mb-3">Give code</h5>
  
                    <div class="mb-5">
                      <div class="form-outline">
                        <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea2">Enter your code</label>
                      </div>
                    </div>
  
                    <hr class="my-4">
  
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5>{{ $subTotal }}</h5>
                    </div>
  
                    <a type="button" href="{{ route('check_out') }}" class="btn btn-dark btn-block btn-lg"
                      data-mdb-ripple-color="dark">Checkout</a>
  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <p>Giỏ hàng của bạn đang trống. Hãy <a >quay lại trang sản phẩm</a>.</p>
@endif
  </section>