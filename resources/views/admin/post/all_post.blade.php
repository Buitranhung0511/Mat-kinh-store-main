<?php

use Illuminate\Support\Facades\Session;
?>

@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Show Post List
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <form class="input-group" role="form" method="GET" name="myForm1" action="{{ route('search-post') }}">
                        <input type="text" name="search_post" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </span>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                {{-- Message hiển thị thông báo active --}}
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
                {{-- End Message.. --}}
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Post title</th>
                            <th>Category post</th>
                            <th>Post desc</th>
                            <th>Post image</th>
                            <th>Post Content</th>
                            <th>Show/Hiden</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($all_post) && count($all_post) > 0)
                            @foreach ($all_post as $key => $post)
                                <tr>
                                    <td>{!! $post->post_title !!}</td>
                                    <td>{{ $post->category_posts_name }}</td>
                                    <td>{!! $post->post_desc !!}</td>

                                    <td><img src="public/uploads/product/{{ $post->post_image }}" width="100"
                                            height="100" alt=""></td>

                                    <td>{!! $post->post_content !!}</td>

                                    <td><span class="text-ellipsis">
                                            @if ($post->post_status == 0)
                                                <a href="{{ '/unactive-post/' . $post->post_id }}">
                                                    <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                                </a>
                                            @else
                                                <a href="{{ '/active-post/' . $post->post_id }}">
                                                    <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                                </a>
                                            @endif
                                        </span></td>

                                    <td>
                                        <a href="{{ URL::to('/edit-post/' . $post->post_id) }}" class="active"
                                            ui-toggle-class="">
                                            <i class="styling-edit fa fa-pencil-square-o text-success text-active"></i>
                                        </a>

                                        <a onclick="return confirm('Are you sure to delete?')"
                                            href="{{ URL::to('/delete-post/' . $post->post_id) }}" class="active"
                                            ui-toggle-class="">
                                            <i class="styling-edit fa fa-times text-danger text"></i></a>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <h3 class="text-alert " style="color:red; ">No Result </h3>
                        @endif

                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        @if ($all_post && $all_post->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_post->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_post->lastPage(); $i++)
                                    <li class="{{ $all_post->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_post->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_post->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        @endif
                    </div>

                </div>
            </footer>
        </div>
    </div>
@endsection
