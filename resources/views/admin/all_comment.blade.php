<!-- resources/views/show_members.blade.php -->

@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Comment
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-3">
                    <form class="input-group" role="form" method="GET" name="myForm1"
                        action="{{ route('search-comment') }}">
                        <input type="text" name="search_comment" class="input-sm form-control" placeholder="Search">
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
                        <th>Comment</th>
                        <th>Product_id</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- form hiển thị tất cả danh sách member --}}
                    @if (isset($all_comment) && count($all_comment) > 0)
                        @foreach ($all_comment as $comm)
                            <tr>
                                <td>{{ $comm->comment_name }}</td>
                                <td>{{ $comm->comment_email }}</td>
                                <td>{{ $comm->comment }}</td>
                                <td>{{ $comm->product_id }}</td>
                                <td>
                                    <span class="text-ellipsis">
                                        @if ($comm->comment_status == 0)
                                            <a href="{{ '/unactive-comment/' . $comm->comment_id }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                            </a>
                                        @else
                                            <a href="{{ '/active-comment/' . $comm->comment_id }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                            </a>
                                        @endif
                                    </span>
                                </td>

                                <td>{{ $comm->comment_date }}</td>

                                <td>
                                    <a onclick="return confirm('Are you sure to delete?')"
                                        href="{{ URL::to('/delete-comment/' . $comm->comment_id) }}" class="active"
                                        ui-toggle-class="">
                                        <i class="styling-edit fa fa-times text-danger text"></i></a>
                                    </a>
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
                        @if ($all_comment && $all_comment->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_comment->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_comment->lastPage(); $i++)
                                    <li class="{{ $all_comment->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_comment->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_comment->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        @endif
                    </div>


                </div>
            </footer>
        </div>
    </div>
@endsection
