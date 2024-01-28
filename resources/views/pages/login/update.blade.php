@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::to('/profile') }}">User Profile</a></li>
                    </ol>
                </nav>
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
                            <button type="button" class="btn btn-primary"><a href="{{ URL::to('/update') }}">Cập Nhật
                                    Thông Tin</a></button>
                            <button type="button" class="btn btn-primary ms-1"><a
                                    href="{{ URL::to('/change-password') }}">Đổi Mật
                                    Khẩu</a></button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <p class="mb-0"><a href="">Lịch sử mua hàng</a></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                <p class="mb-0"><a href="">Đơn Hàng</a></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                <p class="mb-0"><a href="">Ưu Đãi Dành Riêng Cho Bạn</a></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                <p class="mb-0"><a href="">Kho Voucher</a></p>
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

                <form action="{{ url('/update') }}" method="POST">
                    {{-- {!! dd(session()->all()) !!} --}}
                    @csrf

                    <div class="form-group" >
                        <label for="customer_name">Full Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                            value="{{ session('customer_name') }}">
                    </div>

                    <div class="form-group" >
                        <label for="customer_phone">Phone</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                            value="{{ session('customer_phone') }}">
                    </div>

                    <div class="form-group">
                        <label for="customer_address">Address</label>
                        <input type="text" class="form-control" id="customer_address" name="customer_address"
                            value="{{ session('customer_address') }}">
                    </div>

                    <input type="checkbox" id="male" name="customer_gender" value="Nam">
                    <label for="male">Nam</label><br>
                    <input type="checkbox" id="female" name="customer_gender" value="Nữ">
                    <label for="female">Nữ</label><br>
                    <input type="checkbox" id="other" name="customer_gender" value="Khác">
                    <label for="other">Khác</label><br>

                    <input type="date" name="customer_dob" required placeholder="Ngày sinh" />
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </form>
            </div>
        </div>
    @endsection
