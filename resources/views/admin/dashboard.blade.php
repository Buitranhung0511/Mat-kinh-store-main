@extends('admin_layout')
@section('admin_content')
    <h3>Wellcome to Admin</h3>
    <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Data Table Order
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  id="example"
                  class="table table-striped data-table"
                  style="width: 100%"
                >
                  <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Shipping Address</th>
                        <th>Shipping Method</th>
                        <th>Expected Delivery Date</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Additional Notes</th>
                        <th>Discount Code</th>
                        <th>Total Discount</th>
                        <th>Tax Amount</th>
                        <th>User Account ID</th>
                        <th>Refund Status</th>
                        <th>Refund Notes</th>
                      </tr>
                  </thead>
                  <tbody>

                   @foreach($orders as $order)
                   
            <tr>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->shipping_method }}</td>
                <td>{{ $order->expected_delivery_date }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->payment_status }}</td>
                <td class="table">
                    @if($order->order_status == 'Pending')
                        <button
                         class="btn btn-primary order_shipter" onclick="updateOrderStatus({{ $order->id }}, 'comfiml')"
                         data-order-id="{{ $order->id }}"
                            
                            >Mark Shipped</button>
                        
                            <button class="btn btn-danger order_cancel" onclick="updateOrderStatus({{ $order->id }}, 'Cancelled')">Cancel Order</button>
                       @elseif($order->order_status == 'comfiml')
                        <!-- Additional buttons or actions for 'Shipped' status -->
                        <button class="btn btn-success">Confirm Delivery</button>
                        @elseif($order->order_status == 'Cancelled')
                        <!-- Button for 'Cancelled' status -->
                        <button class="btn btn-secondary">Cancelled</button>
                    @else
                        <!-- Additional buttons or actions for other statuses -->
                        <!-- You can add more conditions based on your needs -->
                    @endif
                </td>
                <td>{{ $order->additional_notes }}</td>
                <td>{{ $order->discount_code }}</td>
                <td>{{ $order->total_discount }}</td>
                <td>{{ $order->tax_amount }}</td>
                <td>{{ $order->user_account_id }}</td>
                <td>{{ $order->refund_status }}</td>
                <td>{{ $order->refund_notes }}</td>
            </tr>
        @endforeach
              
                  </tbody>
                 
                </table>
              </div>
            </div>
          
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.order_shipped').click(function () {
        console.log('test')

            var orderId = $(this).data('order-id');
            updateOrderStatus(orderId, 'Shipped');
        });

        $('.order_cancel').click(function () {
            var orderId = $(this).data('order-id');
            updateOrderStatus(orderId, 'Cancelled');
        });

        function updateOrderStatus(orderId, status) {
            $.ajax({
                type: 'GET',
                url: '/update-order-status',
                data: {
                    orderId: orderId,
                    status: status
                },
                success: function (data) {
                    console.log('Order status updated successfully.');
                },
                error: function (error) {
                    console.error('Error updating order status.');
                }
            });
        }
    });
</script>
@endpush