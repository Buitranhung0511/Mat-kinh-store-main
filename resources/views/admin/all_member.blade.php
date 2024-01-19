<!-- resources/views/show_members.blade.php -->

@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Member
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-3">
                    <form class="input-group" role="form" method="GET" name="myForm1" action="{{ route('search') }}">
                        <input type="text" name="key" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </span>
                    </form>
                </div>
            </div>
            <table class="table" id="example">
                {{-- Message hiển thị thông báo active .. --}}
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                    Session::put('message', null);
                }
                ?>
                {{-- End Message --}}

                {{-- Message hiển thị thông báo unactive --}}
                <?php
                $message1 = Session::get('message1');
                if ($message1) {
                    echo '<p class="text-alert " style="color:red; ">' . $message1 . '</p>';
                    Session::put('message1', null);
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- form hiển thị tất cả danh sách member --}}
                    @if (isset($all_member) && count($all_member) > 0)
                        @foreach ($all_member as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->yob }}</td>
                                <td>
                                    @if ($item->is_banned)
                                        <form method="POST" action="{{ route('unban-member', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Unban</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('ban-member', $item->id) }}">
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
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        @if ($all_member && $all_member->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_member->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_member->lastPage(); $i++)
                                    <li class="{{ $all_member->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_member->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_member->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        @endif
                    </div>


                </div>
            </footer>
        </div>
    </div>
@endsection
