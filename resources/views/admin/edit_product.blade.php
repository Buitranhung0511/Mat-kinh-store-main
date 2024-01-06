@extends('admin_layout')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update product
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                            {{-- Message hiển thị thông báo thêm thành công hay thất bại --}}
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                                Session::put('message', null);
                            }
                            ?> <br>
                            {{-- End Message --}}
                            <form role="form" action="{{ URL::to('/update-product/' . $pro->product_id) }}" method="post"
                                enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product name :</label>
                                    <input type="text" class="form-control" name="product_name" id="exampleInputEmail1"
                                        value="{{ $pro->product_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product image :</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }} "
                                        height="100" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product price :</label>
                                    <input type="text" class="form-control" name="product_price" id="exampleInputEmail1"
                                        value="{{ $pro->product_price }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discription</label>
                                    <textarea style='resize: none;' rows='8' class="form-control" name="product_desc" id="exampleInputPassword1">
                                        {{ $pro->product_desc }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product content</label>
                                    <textarea style='resize: none;' rows='8' class="form-control" name="product_content" id="exampleInputPassword1">
                                        {{ $pro->product_content }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category : </label>
                                    <select name="product_cate" class="form-control input-sm m-bot15 ">
                                        {{-- Sử dụng foreach để lấy tên category --}}
                                        @foreach ($cate_product as $key => $cate)
                                            @if (is_object($cate) && property_exists($cate, 'category_name'))
                                                @if ($cate->category_id == $pro->category_id)
                                                    <option selected value="{{ $cate->category_id }}">
                                                        {{ $cate->category_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $cate->category_id }}">
                                                        {{ $cate->category_name }}
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="product_status" class="form-control input-sm m-bot15 ">
                                        <option value="1">Hiden</option>
                                        <option value="0">Show</option>
                                    </select>
                                </div>


                                <button type="submit" name="add-product" class="btn btn-info ">Update</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
