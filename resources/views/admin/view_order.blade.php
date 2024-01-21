@extends('admin_layout')
@section('admin-content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin đăng nhập
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Customer name</th>
                            <th>Phone</th>
                            <th>Email</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_order as $ord)
                            <tr>
                                <td>{{ $ord->customer_name }}</td>
                                <td>{{ $ord->phone_number }}</td>
                                <td>{{ $ord->email }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">

                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        @if ($all_order && $all_order->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_order->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_order->lastPage(); $i++)
                                    <li class="{{ $all_order->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_order->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_order->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        @endif
                    </div>

                </div>
            </footer>
            {{--  --}}
        </div>
    </div>
    <br>

    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Order ID</th>
                            <th>Customer name</th>
                            <th>Customer email</th>
                            <th>Product name</th>
                            <th>Product price</th>
                            <th>Discount code</th>
                            <th>Order status</th>
                            <th>Quantity</th>
                            <th>Total amount</th>
                            <th>Total discount</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_order as $ord)
                            <tr>
                                <td>{{ $ord->id }}</td>
                                <td>{{ $ord->customer_name }}</td>
                                <td>{{ $ord->email }}</td>
                                <td>{{ $ord->product_name }}</td>
                                <td>{{ $ord->product_price }}</td>
                                <td>{{ $ord->discount_code }}</td>
                                <td>{{ $ord->order_status }}</td>
                                <td>{{ $ord->quantity }}</td>
                                <td>{{ $ord->total_amount }}</td>
                                <td>{{ $ord->total_discount }}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">

                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        @if ($all_order && $all_order->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_order->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_order->lastPage(); $i++)
                                    <li class="{{ $all_order->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_order->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_order->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        @endif
                    </div>

                </div>
            </footer>

        </div>
    </div>
@endsection
