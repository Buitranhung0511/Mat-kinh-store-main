@extends('layout')
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
                        <form method="POST" action="{{ URL::to('/recover-pass') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input name="email_accout" type="email" class="form-control" name="customer_email"
                                        value="" required>


                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
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
