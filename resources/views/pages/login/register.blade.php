@extends('layout')
@section('content')
    <div class="container">
        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->


                <h2>Đăng ký mới!</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ URL::to('/add-customer') }}" method="POST">
                    @csrf
                    <input type="text" name="customer_name" required placeholder="Họ và Tên" />
                    @if ($errors->has('customer_name'))
                        <div class="alert alert-danger">{{ $errors->first('customer_name') }}</div>
                    @endif
                    <input type="email" name="customer_email" required placeholder="Địa chỉ email" />
                    @if ($errors->has('customer_email'))
                        <div class="alert alert-danger">{{ $errors->first('customer_email') }}</div>
                    @endif
                    <input type="password" name="customer_password" required placeholder="Mật khẩu" />
                    @if ($errors->has('customer_password'))
                        <div class="alert alert-danger">{{ $errors->first('customer_password') }}</div>
                    @endif
                    <input type="text" name="customer_phone" required placeholder="Phone" />
                    @if ($errors->has('customer_phone'))
                        <div class="alert alert-danger">{{ $errors->first('customer_phone') }}</div>
                    @endif
                    <input type="text" name="customer_address" required placeholder="Địa chỉ" />
                    @if ($errors->has('customer_address'))
                        <div class="alert alert-danger">{{ $errors->first('customer_address') }}</div>
                    @endif
                    <div style="display: flex;">
                        <div>
                            <label><input type="checkbox" name="customer_gender" value="Nam"> Nam</label>
                            <label><input type="checkbox" name="customer_gender" value="Nữ"> Nữ</label>
                            <label><input type="checkbox" name="customer_gender" value="Khác"> Khác</label>
                        </div>
                    </div>
                    @if ($errors->has('customer_gender'))
                        <div class="alert alert-danger">{{ $errors->first('customer_gender') }}</div>
                    @endif
                    <input type="date" name="customer_dob" required placeholder="Ngày sinh" />
                    @if ($errors->has('customer_dob'))
                        <div class="alert alert-danger">{{ $errors->first('customer_dob') }}</div>
                    @endif
                    <button type="submit" class="btn btn-default">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>



@endsection
