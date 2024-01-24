<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update post
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        @foreach ($edit_post as $key => $post)
                            {{-- Message hiển thị thông báo thêm thành công hay thất bại.. --}}
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                                Session::put('message', null);
                            }
                            ?> <br>
                            {{-- End Message --}}
                            <form role="form" action="{{ URL::to('/update-post/' . $post->post_id) }}" method="post"
                                enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post title :</label>
                                    {{-- <input type="text" class="form-control" name="post_title" id="exampleInputEmail1"
                                        value="{{ $post->post_title }}"> --}}
                                    <textarea style='resize: none;' rows='8' class="form-control" name="post_title" id="editor">{{ $post->post_title }}"
                                        </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category post name: </label>
                                    <select name="cate_post_id" class="form-control input-sm m-bot15 " required>
                                        {{-- Sử dụng foreach để lấy tên category --}}
                                        @foreach ($cate_post as $key => $catepost)
                                            @if (is_object($catepost) && property_exists($catepost, 'category_posts_name'))
                                                @if ($catepost->category_posts_id == $post->category_posts_id)
                                                    <option selected value="{{ $catepost->category_posts_id }}">
                                                        {{ $catepost->category_posts_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $catepost->category_posts_id }}">
                                                        {{ $catepost->category_posts_name }}
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post desc</label>
                                    <textarea style='resize: none;' rows='8' class="form-control" name="post_desc" id="editor2">{{ $post->post_desc }}
                                        </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post image :</label>
                                    <input type="file" class="form-control" name="post_image" id="exampleInputEmail1">
                                    <img src="{{ URL::to('public/uploads/product/' . $post->post_image) }} " height="100"
                                        width="100">
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post content</label>
                                    <textarea style='resize: none;' rows='8' class="form-control" name="post_content" id="editor3">{{ $post->post_content }}
                                        </textarea>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="post_status" class="form-control input-sm m-bot15 ">
                                        <option value="1">Hiden</option>
                                        <option value="0">Show</option>
                                    </select>
                                </div>


                                <button type="submit" name="add-product" class="btn btn-info ">Update</button>
                                <button type="cancel" name="cancel-product" class="btn btn-warning ">Cancel</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
