<?php
use Illuminate\Support\Facades\Session;

?>

@extends('admin_layout')
@section('admin_content')
    <table class="table panel panel-default" id="example">
        <div class="panel-heading">
            All Member
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5">

            </div>
            <div class="col-sm-4">

            </div>
            <div class="col-sm-3">
                <form class="input-group" role="form" method="GET" name="myForm1" action="{{ route('search') }}">
                    <input type="text" name="seach" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-success" type="submit">Search</button>
                    </span>
                </form>
            </div>
        </div>
        {{-- Message hiển thị thông báo active .. --}}
        <?php
        $message = Session::get('message3');
        if ($message) {
            echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
            Session::put('message3', null);
        }
        ?>
        {{-- End Message --}}

        {{-- Message hiển thị thông báo unactive --}}
        <?php
        $message1 = Session::get('message2');
        if ($message1) {
            echo '<p class="text-alert " style="color:red; ">' . $message1 . '</p>';
            Session::put('message2', null);
        }
        ?>
        {{-- End Message --}}
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Year of Birth</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- form hiển thị tất cả danh sách member --}}
            @if (isset($all_member) && count($all_member) > 0)
                @foreach ($all_member as $item)
                    <tr>
                        <td>{{ $item->customer_name }}</td>
                        <td>{{ $item->customer_email }}</td>
                        <td>{{ $item->customer_phone }}</td>
                        <td>{{ $item->customer_address }}</td>
                        <td>{{ $item->customer_dob }}</td>
                        <td>{{ $item->customer_gender }}</td>

                        <td>
                            @if ($item->customer_ban)
                                <form method="POST" action="{{ route('uban-customer', $item->customer_id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Unban</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('ban-customer', $item->customer_id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Ban</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <h3 class="text-alert " style="color:red; ">No Result </h3>
            @endif

            {{-- end form --}}
        </tbody>

    </table>
@endsection
