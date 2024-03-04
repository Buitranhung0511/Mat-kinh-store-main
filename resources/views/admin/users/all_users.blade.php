<?php
use Illuminate\Support\Facades\Session;
?>
@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users List
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Search</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên user</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Author</th>
                            <th>Admin</th>
                            <th>User</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $key => $user)
                            <form action="{{ url('/assign-roles') }}" method="POST">
                                @csrf
                                <tr>
                                    <td>{{ $user->admin_name }}</td>
                                    <td>{{ $user->admin_email }} <input type="hidden" name="admin_email"
                                            value="{{ $user->admin_email }}"></td>
                                    <td>{{ $user->admin_phone }}</td>
                                    <td>{{ $user->admin_password }}</td>

                                    <td><input type="checkbox" name="author_role"
                                            {{ $user->hasRole('author') ? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="admin_role"
                                            {{ $user->hasRole('admin') ? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="user_role"
                                            {{ $user->hasRole('user') ? 'checked' : '' }}></td>

                                    <td>


                                        <input type="submit" value="Assign roles" class="btn btn-sm btn-default">

                                    </td>

                                </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!! $admin->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
