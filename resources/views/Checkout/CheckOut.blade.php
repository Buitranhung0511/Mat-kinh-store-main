
@extends('layout')
@section('content')
<section class="bg-light" style=" font-size: 20px;">
    <div class="container ">


      <div class="row ">
        <div class="col-xl-8 col-lg-8 mb-6">
          <div class="card mb-4 border shadow-0">
            <div class="p-4 d-flex justify-content-between">
              <div class="">
                <h5 style=" font-size: 20px;">Have an account?</h5>
                <p class="mb-0 text-wrap ">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
              <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
                <a href="#" class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
                <a href="#" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
              </div>
            </div>
          </div>
  
          <!-- Checkout -->
          <form id="checkoutForm" action="{{ route('input_data') }}" method="GET" class="">
          
            <div class="card shadow-0 border card-registration card-registration-2">
              <div class="p-4">
                <h5 class="card-title mb-3">Guest checkout</h5>
                <div class="row">
                  <div class="col-6 mb-3">
                    <p class="mb-0">Fullname name</p>
                    <div class="form-outline">
                      <input type="text" id="inputFullname" placeholder="Type here" class="form-control" />
                    </div>
                  </div>
    
                  <div class="col-6 mb-3">
                    <p class="mb-0">Phone</p>
                    <div class="form-outline">
                      <input type="tel" id="inputPhone" value="+48 " class="form-control" />
                    </div>
                  </div>
    
                  <div class="col-6 mb-3">
                    <p class="mb-0">Email</p>
                    <div class="form-outline">
                      <input type="email" id="inputEmail" placeholder="example@gmail.com" class="form-control" />
                    </div>
                  </div>
                </div>
    
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">Keep me up to date on news</label>
                </div>
    
                <hr class="my-4" />
    
                <h5 class="card-title mb-3">Shipping info</h5>
    
                <div class="row mb-3">
                  <div class="col-lg-4 mb-3">
                    <!-- Default checked radio -->
                    <div class="form-check h-100 border rounded-3">
                      <div class="p-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked />
                        <label class="form-check-label" for="flexRadioDefault1">
                          Express delivery <br />
                          <small class="text-muted">3-4 days via Fedex </small>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <!-- Default radio -->
                    <div class="form-check h-100 border rounded-3">
                      <div class="p-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          Post office <br />
                          <small class="text-muted">20-30 days via post </small>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <!-- Default radio -->
                    <div class="form-check h-100 border rounded-3">
                      <div class="p-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                        <label class="form-check-label" for="flexRadioDefault3">
                          Self pick-up <br />
                          <small class="text-muted">Come to our shop </small>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col-sm-8 mb-3">
                    <p class="mb-0">Address</p>
                    <div class="form-outline">
                      <input type="text" id="inputAddress" placeholder="Type here" class="form-control" />
                    </div>
                  </div>
    
                  <div class="col-sm-4 mb-3">
                    <p class="mb-0">City</p>
                    <select class="form-select" id="citySelect">
                      <option value="1">New York</option>
                      <option value="2">Moscow</option>
                      <option value="3">Samarqand</option>
                    </select>
                  </div>
    
                  <div class="col-sm-4 mb-3">
                    <p class="mb-0">House</p>
                    <div class="form-outline">
                      <input type="text" id="inputHause" placeholder="Type here" class="form-control" />
                    </div>
                  </div>
    
                  <div class="col-sm-4 col-6 mb-3">
                    <p class="mb-0">Postal code</p>
                    <div class="form-outline">
                      <input type="text" id="postalCodeInput" class="form-control" />
                    </div>
                  </div>
    
                  <div class="col-sm-4 col-6 mb-3">
                    <p class="mb-0">Zip</p>
                    <div class="form-outline">
                      <input type="text" id="zipInput" class="form-control" />
                    </div>
                  </div>
                </div>
    
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                  <label class="form-check-label" for="flexCheckDefault1">Save this address</label>
                </div>
    
                <div class="mb-3">
                  <p class="mb-0">Message to seller</p>
                  <div class="form-outline">
                    <textarea class="form-control" id="textAreaExample1" rows="2"></textarea>
                  </div>
                </div>
    
                <div class="float-end">
                  <button type="button" class="btn btn-light border" id="cancelBtn">Cancel</button>
                  <button type="button" id="showModalButton" class="btn btn-primary contineu" data-toggle="modal"  >
                   Contineu
                  </button>
                </div>
              </div>
            </div>
          </form>
          <!-- Checkout -->
        </div>
        @php
        $subTotal = 0  ;
        $allProductNames = [];
        @endphp
    @foreach ($carts as $id=>  $cart)
        @php
          $subTotal  += $cart['price']  * $cart['quantity'];
          $allProductNames[] = $cart['name'];
        @endphp
        @endforeach
       
        <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
          <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
            <h4 class="mb-3" style="font-size: 20px; ">Summary</h4>
            <div class="d-flex justify-content-between">
              <p class="mb-2">nameProduct:</p>
              <p class="mb-2">@foreach ($allProductNames as $productName)
                {{ $productName }},
            @endforeach</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Total price:</p>
              <p class="mb-2">{{ $subTotal }}</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Discount:</p>
              <p class="mb-2 text-danger">- $60.00</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Shipping cost:</p>
              <p class="mb-2">+ $14.00</p>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
              <p class="mb-2">Total price:</p>
              <p class="mb-2 fw-bold">{{ $subTotal }}</p>
            </div>
  
            <div class="input-group mt-3 mb-4">
              <input type="text" class="form-control border" name="" placeholder="Promo code" />
             
             <form action="{{ route('vn_onepay') }}" method="POST">
              @csrf
              <input type="hidden" name="vn_onepay" value="{{ $subTotal }}">
             <button type="submit" class="btn btn-light text-primary border" 
           
             name="vpcURL">Onepay</button>
           </form>
            </div>
        </section>
        {{-- modal buill --}}
        <div class="modal " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Form fields -->
                <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                  <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
                    <h4 class="mb-3">Summary</h4>
                    <p class="mb-2">nameProduct:</p>
              <p class="mb-2">@foreach ($allProductNames as $productName)
                {{ $productName }},
            @endforeach</p>
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Total price:</p>
                      <p class="mb-2">{{ $subTotal }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Discount:</p>
                      <p class="mb-2 text-danger">- $60.00</p>
                    </div>
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping cost:</p>
                      <p class="mb-2">+ $14.00</p>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Total price:</p>
                      <p class="mb-2 fw-bold">{{ $subTotal }}</p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nameUser">Name User:</label>
                  <input type="text" class="form-control" id="nameUser" readonly>
                </div>
                <div class="form-group">
                  <label for="phoneUser">Phone User:</label>
                  <input type="text" class="form-control" id="phoneUser" readonly>
                </div>
                <div class="form-group">
                  <label for="emailUser">Email User:</label>
                  <input type="text" class="form-control" id="emailUser" readonly>
                </div>
                <div class="form-group">
                  <label for="address">Address:</label>
                  <textarea class="form-control" id="address" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                  <label>Payment Method:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="1" checked>
                    <label class="form-check-label" for="cash">Cash</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="bank_vnpay" value="2">
                    <label class="form-check-label" for="bankTransfer">Bank Vnpay</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="bank_momo" value="3">
                    <label class="form-check-label" for="bankTransfer">Bank Momo</label>
                  </div>
                  <!-- Add more radio buttons as needed -->
                </div>
               <br> 
        <div class="form-group mb-5 d-flex justify-content-center">
          <button type="button" class="btn btn-primary" id="submitButton">Order</button>
        </div>
          <div class="ml-3" >
            <form  action="{{ route('vn_payment') }}" method="POST"  >
              @csrf
              <input type="hidden" name="vn_payment" value="{{ $subTotal }}">
              
              <button type="submit" id="vn_payment" style="display: none;"  name="redirect">
              </button>
           </form>
           <form  action="{{ route('vn_momo') }}" method="POST" >
             @csrf
             <input type="hidden" name="vn_momo" value="{{ $subTotal}}">

             <button type="submit" id="vn_momo" style="display: none;" class="btn btn-primary w-90 mx-2" name="payUrl">
              <i class="fas fa-money-bill-wave"></i> Momo
            </button>
          </form>
            <button type="button" class="btn btn-primary"style="display: none;" id="cashButton">Cash</button>
          </div>
        </div>
      </div>
              
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
@endsection

