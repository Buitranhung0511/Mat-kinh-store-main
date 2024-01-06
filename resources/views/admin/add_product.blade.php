<?php

use Illuminate\Support\Facades\Session;
?>

@extends('admin_layout')
@section('admin-content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add product
            </header>
            <div class="panel-body">

                <div class="position-center">
                    {{-- Message hiển thị thông báo thêm thành công hay thất bại --}}
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                        Session::put('message', null);
                    }
                    ?> <br>
                    {{-- End Message --}}
                    <form name="myForm1" role="form" action="{{ URL::to('/save-product') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm('myForm1')">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product name :</label>
                            <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" data-validation="length" data-validation-length="min3">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product price :</label>
                            <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Discription</label>
                            <textarea style='resize: none;' id="editor" rows='8' class="form-control" name="product_desc">
                                                        </textarea>
                        </div>



                        <div class="form-group">
                            <label for="exampleInputPassword1">Product content</label>
                            <textarea style='resize: none;' rows='8' class="form-control" name="product_content" id="editor2">
                                                        </textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Category : </label>
                            <select name="product_cate" class="form-control input-sm m-bot15 ">
                                {{-- Sử dụng foreach để lấy tên category --}}
                                @foreach ($cate_product as $key => $cate)
                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product image :</label>
                            <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Show</label>
                            <select name="product_status" class="form-control input-sm m-bot15 ">
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