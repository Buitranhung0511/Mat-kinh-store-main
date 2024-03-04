@extends('layout')
@section('content')
    <div class="container">
        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->


                <h2>New registration!</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ URL::to('/add-customer') }}" method="POST">
                    @csrf
                    <input type="text" name="customer_name" placeholder="First and last name" />
                    @if ($errors->has('customer_name'))
                        <div class="alert alert-danger">{{ $errors->first('customer_name') }}</div>
                    @endif
                    <input type="email" name="customer_email" placeholder="Address email" />
                    @if ($errors->has('customer_email'))
                        <div class="alert alert-danger">{{ $errors->first('customer_email') }}</div>
                    @endif
                    <input type="password" name="customer_password" placeholder="Password" />
                    @if ($errors->has('customer_password'))
                        <div class="alert alert-danger">{{ $errors->first('customer_password') }}</div>
                    @endif
                    <input type="password" name="customer_password_confirmation" placeholder="Confirm password" />
                    @if ($errors->has('customer_password_confirmation'))
                        <div class="alert alert-danger">{{ $errors->first('customer_password_confirmation') }}</div>
                    @endif
                    <input type="text" name="customer_phone" placeholder="Phone" />
                    @if ($errors->has('customer_hpone'))
                        <div class="alert alert-danger">{{ $errors->first('customer_phone') }}</div>
                    @endif
                    <input type="text" name="customer_address" placeholder="Address" />
                    @if ($errors->has('customer_address'))
                        <div class="alert alert-danger">{{ $errors->first('customer_address') }}</div>
                    @endif
                    <div style="display: flex;">
                        <div>
                            <label><input type="radio" name="customer_gender" value="Male"> Male</label>
                            <label><input type="radio" name="customer_gender" value="Female"> Female</label>
                            <label><input type="radio" name="customer_gender" value="Other"> Orther</label>
                        </div>
                    </div>
                    @if ($errors->has('customer_gender'))
                        <div class="alert alert-danger">{{ $errors->first('customer_gender') }}</div>
                    @endif
                    <input type="date" name="customer_dob" placeholder="Birth-day" />
                    @if ($errors->has('customer_dob'))
                        <div class="alert alert-danger">{{ $errors->first('customer_dob') }}</div>
                    @endif
                    <button type="submit" class="btn btn-default">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
