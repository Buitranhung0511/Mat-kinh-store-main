@extends('layout')
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">


            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">

                            {{-- <form method="POST" action="{{ route('upload-avatar') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="avatar" id="avatar">
                                <button type="submit">Upload Avatar</button>
                            </form> --}}


                            <h5 class="my-3">{{ session('customer_name') }}</h5>
                            <p class="text-muted mb-1">{{ session('customer_phone') }}</p>
                            <p class="text-muted mb-4">{{ session('customer_address') }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary"><a href="{{ URL::to('/update') }}">Update
                                        Information</a></button>
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
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_gender') }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Date of birth</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ session('customer_dob') }}</p>
                                </div>
                            </div>
                            <a href="{{ url('/update') }}" class="btn btn-primary">Update Information</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
