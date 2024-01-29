@extends('layout')
@section('content')
    {{-- --}}
    <section class="vh-100">
        <div class="container py-5 h-100" style="padding-bottom: 31rem!important;">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                        class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session()->has('ok'))
                            <div class="alert alert-success">
                                {{ session()->get('ok') }}
                            </div>
                        @elseif (session()->has('fail'))
                            <div class="alert alert-danger">
                                {{ session()->get('fail') }}
                            </div>
                        @endif
                    <form action="{{ URL::to('/login-customer') }}" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" name="email_accout" required placeholder="Enter email"
                                class="form-control form-control-lg" />

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name ="password_accout" required placeholder="Enter Password "
                                class="form-control form-control-lg" />

                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                            <a href="{{ URL::to('/register') }}">Register</a>
                            <a href="{{ URL::to('/forgot-password') }}">Forgot-Password</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                        </div>

                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                            role="button">
                            <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                        </a>
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                            role="button">
                            <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
