<?php

use Illuminate\Support\Facades\Session;
?>

@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Show Category Post List
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <form class="input-group" role="form" method="GET" name="myForm1"
                        action="{{ route('search-cate-post') }}">
                        <input type="text" name="search_cate_post" class="input-sm form-control" placeholder="Search">
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

                            <th>Category post name</th>
                            <th>Description</th>
                            <th>Status</th>


                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($all_category_post) && count($all_category_post) > 0)
                            @foreach ($all_category_post as $key => $catepost)
                                <tr>

                                    <td>{{ $catepost->category_posts_name }}</td>
                                    <td>{{ $catepost->category_posts_desc }}</td>
                                    {{-- <td><img src="public/uploads/product/{{ $pro->product_image }}" width="100"
                                            height="100" alt=""></td>
                                    <td>{{ $pro->category_name }}</td> --}}

                                    <td><span class="text-ellipsis">
                                            @if ($catepost->category_posts_status == 0)
                                                <a href="{{ '/unactive-cate-post/' . $catepost->category_posts_id }}">
                                                    <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                                </a>
                                            @else
                                                <a href="{{ '/active-cate-post/' . $catepost->category_posts_id }}">
                                                    <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                                </a>
                                            @endif
                                        </span></td>

                                    <td>
                                        <a href="{{ URL::to('/edit-cate-post/' . $catepost->category_posts_id) }}"
                                            class="active" ui-toggle-class="">
                                            <i class="styling-edit fa fa-pencil-square-o text-success text-active"></i>
                                        </a>

                                        <a onclick="return confirm('Are you sure to delete?')"
                                            href="{{ URL::to('/delete-cate-post/' . $catepost->category_posts_id) }}"
                                            class="active" ui-toggle-class="">
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
                        @if ($all_category_post && $all_category_post->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_category_post->previousPageUrl() }}"><i
                                            class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_category_post->lastPage(); $i++)
                                    <li class="{{ $all_category_post->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_category_post->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_category_post->nextPageUrl() }}"><i
                                            class="fa fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        @endif
                    </div>

                </div>
            </footer>
        </div>
    </div>
@endsection
