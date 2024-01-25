@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <h2 style="color: skyblue">Product Catalog</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-product-->
                        @foreach ($category as $key => $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category_product" data-urlCategory="{{ URL::to('/danh-muc-san-pham/') }}"
                                            data-id="{{ $cate->category_id }}" style="">{{ $cate->category_name }}</a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div><!--/category-products-->

              

                    <!-- price-range-->
                    <div class="price-range">
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <!--/price-range -->


                    <div class="shipping text-center"><!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            {{-- Body Home --}}
            <div class="col-sm-9 padding-right">
                <!--features_items-->

                <div class="product_parent">

                    <div class="features_items ">
                        <h2 class="title text-center">New Products</h2>

                        @foreach ($all_product as $key => $product)
                            <a href="{{ URL::to('chi-tiet-san-pham/' . $product->product_id) }}">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                    alt="" />
                                                <h2>{{ number_format($product->product_price) }}</h2>
                                                <h3>{{ $product->product_name }}</h3>
                                                <a data-url="{{ route('addToCard', ['id' => $product->product_id]) }}"
                                                    class="btn btn-warning cart_edit update_cart_url"><i
                                                        class="fa fa-shopping-cart"></i>Add to
                                                    cart</a>
                                            </div>
                                        </div>


                                        <div class="choose">
                                            <ul class="nav nav-pills "
                                                style="display: flex; flex-wrap: wrap; justify-content: space-around">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div><!--features_items-->

                    <!-- Phân trang -->
                    {{-- <div class="text-center" id="pagination" style="color: skyblue">
                        {{ $all_product->links() }}
                    </div> --}}
                </div>
            </div>
            {{-- And Body Home --}}
        </div>
    </div>
@endsection
