@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center">Search results</h2>
        @foreach ($search_product as $key => $product)
            <a href="{{ URL::to('chi-tiet-san-pham/' . $product->product_id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                    alt="" />
                                <h2>{{ number_format($product->product_price) . ' ' . '$' }}</h2>
                                <p>{{ $product->product_name }}</p>
                                <a data-url="{{ route('addToCard', ['id' => $product->product_id]) }}"
                                    class="btn btn-default add_to_card"><i class="fa fa-shopping-cart"></i>Add to
                                    cart</a>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills"
                                style="display: flex; flex-wrap: wrap; justify-content: space-around;">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Additional favorite</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Comparison</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div><!--features_items-->
@endsection
