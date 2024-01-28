@extends('layout')
@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        .pass_show {
            position: relative
        }

        .pass_show .ptxt {

            position: absolute;

            top: 50%;

            right: 10px;

            z-index: 1;

            color: #f36c01;

            margin-top: -10px;

            cursor: pointer;

            transition: .3s ease all;

        }

        .pass_show .ptxt:hover {
            color: #333333;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Show</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Show" ? "Hide" : "Show");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
    </script>


    <br> <br>

    <div class="container">
        <div class="row">
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
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
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
            <div class="col-sm-4">

                <form action="{{ route('change-password1') }}" method="post">
                    {{-- {!! dd(session()->all()) !!} --}}
                    @csrf
                    <label>email</label>
                    <div class="form-group pass_show">
                        <input type="text" id="customer_email" required name="customer_email" class="form-control"
                            placeholder="Current Password">
                    </div>

                    <label>Current Password</label>
                    <div class="form-group pass_show">
                        <input type="password" id="current_password" required name="current_password" class="form-control"
                            placeholder="Current Password">
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show">
                        <input type="password" id="new_password" name="new_password" required class="form-control"
                            placeholder="New Password">
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show">
                        <input type="password" id="confirm_password" name="confirm_password" required class="form-control"
                            placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
