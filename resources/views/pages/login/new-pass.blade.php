!@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">

                        @if (session()->has('win'))
                            <div class="alert alert-success">
                                {{ session()->get('win') }}
                            </div>
                        @elseif (session()->has('loi'))
                            <div class="alert alert-danger">
                                {{ session()->get('loi') }}
                            </div>
                        @endif

                        @php
                            $token = $_GET['token'];
                            $email = $_GET['email'];
                        @endphp
                        <form method="post" action="{{ URL::to('/update-new-pass') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Enter new password') }}</label>

                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" name="email" value="({$email})">
                                    <input type="hidden" class="form-control" name="token" value="({$token})">

                                    <input name="email_accout" type="password" class="form-control" name="password_accout"
                                        value="" required>


                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send New Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
