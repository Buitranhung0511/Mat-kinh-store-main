<?php

use Illuminate\Support\Facades\Session;
?>

@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add post
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        <!-- {{-- Message hiển thị thông báo thêm thành công hay thất bại --}} -->
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                            Session::put('message', null);
                        }
                        ?> <br>
                        {{-- End Message --}}
                        <form name="myForm1" role="form" action="{{ URL::to('/save-post') }}" method="post"
                            enctype="multipart/form-data" onsubmit="return validateForm('myForm1')">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Post title </label>
                                <textarea style='resize: none;' rows='8' class="form-control" name="post_title" id="editor">
                                    </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Category posts id </label>
                                <select name="post_cate" class="form-control input-sm m-bot15 ">
                                    {{-- Sử dụng foreach để lấy tên category --}}
                                    @foreach ($cate_post as $key => $cate)
                                        <option value="{{ $cate->category_posts_id }}">{{ $cate->category_posts_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Post desc </label>
                                <textarea style='resize: none;' rows='8' class="form-control" name="post_desc" id="editor2">
                                                        </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Post content</label>
                                <textarea style='resize: none;' rows='8' class="form-control" name="post_content" id="editor3">
                                                        </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Post image </label>
                                <input type="file" class="form-control" name="post_image" id="exampleInputEmail1">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Post status</label>
                                <select name="post_status" class="form-control input-sm m-bot15 ">
                                    <option value="0">Hiden</option>
                                    <option value="1">Show</option>
                                </select>
                            </div>

                            <button type="submit" name="add-product" class="btn btn-info ">Add</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    </div>
    </div>
@endsection
