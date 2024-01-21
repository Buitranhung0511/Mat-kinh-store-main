@extends('layout')
@section('content')

<div class="container mt-3">
    <div class="jumbotron text-center">
      <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Thông tin Đơn Hàng</h1>
            </div>
            <div class="card-body">
                <h3 class="card-subtitle mb-2 text-muted">Thông tin Khách Hàng:</h3>
                <p class="card-text">Tên Khách Hàng: {{ $order->customer_name }}</p>
                <p class="card-text">Email: {{ $order->email }}</p>
                <p class="card-text">Số Điện Thoại: {{ $order->phone_number }}</p>

                <h3 class="card-subtitle mb-2 text-muted">Thông tin Đơn Hàng:</h3>
                <p class="card-text">Tổng Số Tiền: {{ $order->total_amount }}</p>
                <!-- Thêm các trường khác nếu cần -->
              
            </div>
            <div class="container mt-4">
              <h2>Order Details</h2>
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>

                          <!-- Add more columns as needed -->
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($orderDetails as $orderDetail)
                          <tr>
                              <td>{{ $orderDetail->product_name }}</td>
                              <td>{{ $orderDetail->quantity }}</td>
                              <td>{{ $orderDetail->product_price }}</td>

                              <!-- Add more fields as needed -->
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
        </div>
    </div>
      <h1 class="display-4">Thank You!</h1>
      <p class="lead">Your message has been received.</p>
      <hr class="my-4">
      <p>We appreciate your feedback.</p>
      {{-- <a class="btn btn-primary btn-lg" href="{{ route('home') }}" role="button">Back to Home</a> --}}
    </div>
  </div>

@endsection