@extends('admin_layout')
@section('admin-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4">Profile</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.updateProfile') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $customer->name }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $customer->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $customer->phone }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $customer->address }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="yob" class="form-label">Year of Birth:</label>
                        <input type="text" class="form-control" id="yob" name="yob" value="{{ old('yob') }}"
                            value="{{ $customer->yob }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    {{--  --}}
@endsection
