<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Category Post
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        @foreach ($edit_category_post as $key => $catepost)
                            {{-- Message hiển thị thông báo thêm thành công hay thất bại.. --}}
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                                Session::put('message', null);
                            }
                            ?> <br>
                            {{-- End Message --}}
                            <form role="form" action="{{ URL::to('/update-cate-post/' . $catepost->category_posts_id) }}"
                                method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category post name :</label>
                                    <input type="text" class="form-control" name="cate_post_name" id="exampleInputEmail1"
                                        value="{{ $catepost->category_posts_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discription</label>
                                    <textarea style='resize: none;' rows='8' class="form-control" name="cate_post_desc" id="exampleInputPassword1">
                                        {{ $catepost->category_posts_desc }}
                                    </textarea>
                                </div>

                                <button type="submit" name="add-product" class="btn btn-info ">Update</button>
                                <button type="cancel" name="cancel-category-post" class="btn btn-warning ">Cancel</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
