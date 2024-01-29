@extends('layout')
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">

                            </form>
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
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">

                            @if (session('success1'))
                                <div class="alert alert-success">
                                    {{ session('success1') }}
                                </div>
                            @endif

                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_name') }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_email') }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_phone') }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_address') }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Giới Tính</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_gender') }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Ngày Sinh</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_dob') }}</p>
                                </div>
                            </div>
                            <a href="{{ url('/update') }}" class="btn btn-primary">Cập Nhật Thông Tin</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
