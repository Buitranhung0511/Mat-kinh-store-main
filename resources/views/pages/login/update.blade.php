@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ session('customer_name') }}</h5>
                        <p class="text-muted mb-1">{{ session('customer_phone') }}</p>
                        <p class="text-muted mb-4">{{ session('customer_address') }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-primary"><a href="{{ URL::to('/update') }}">Update
                                    Thông Tin</a></button>
                            <button type="button" class="btn btn-primary ms-1"><a
                                    href="{{ URL::to('/change-password') }}">Change Password</a></button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <p class="mb-0"><a href="">Buy history</a></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">

                                <p class="mb-0"><a href="">Order</a></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">

                                <p class="mb-0"><a href="">Exclusive discount for you</a></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">

                                <p class="mb-0"><a href="">Voucher</a></p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ url('/update') }}" method="POST">
                    {{-- {!! dd(session()->all()) !!} --}}
                    @csrf

                    <div class="form-group">
                        <label for="customer_name">Full Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                            value="{{ session('customer_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Phone</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                            value="{{ session('customer_phone') }}">
                    </div>

                    <div class="form-group">
                        <label for="customer_address">Address</label>
                        <input type="text" class="form-control" id="customer_address" name="customer_address"
                            value="{{ session('customer_address') }}">
                    </div>

                    <input type="radio" id="male" required name="customer_gender" value="Nam">
                    <label for="male">Male</label><br>
                    <input type="radio" id="female" required name="customer_gender" value="Nữ">
                    <label for="female">Female</label><br>
                    <input type="radio" id="other" required name="customer_gender" value="Khác">
                    <label for="other">Other</label><br>

                    <input type="date" name="customer_dob" required placeholder="Ngày sinh"
                        value="{{ session('customer_dob') }}" />
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    @endsection
