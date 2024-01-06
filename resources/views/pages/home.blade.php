@extends('layout')
@section('content')
{{-- carousel --}}
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('frontend/images/girl1.jpg') }}" class="girl img-responsive" alt="" />
                                <img src="{{ asset('frontend/images/pricing.png') }}" class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('frontend/images/girl2.jpg') }}" class="girl img-responsive" alt="" />
                                <img src="{{ asset('frontend/images/pricing.png') }}" class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('frontend/images/girl3.jpg') }}" class="girl img-responsive" alt="" />
                                <img src="{{ asset('frontend/images/pricing.png') }}" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="left-sidebar">

                    <h2>Danh Mục Sản Phẩm</h2>


                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        {{-- @foreach($category as $key => $cate)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
                            </div>
                        </div>
                        @endforeach --}}
                    </div><!--/category-products-->

                    <!--brands_products-->
                    <!-- <div class="brands_products">
                        <h2>Thương Hiệu Sản Phẩm</h2>
                        <div class="brands-name">

                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                            </ul>
                        </div>
                    </div> -->
                    <!--/brands_products-->


                    <!--price-range-->
                    <!-- <div class="price-range">
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0"
                                data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div> -->
                    <!--/price-range-->

                    <div class="features_items">
                        <h2 class="title text-center">Sản Phảm Mới Nhất</h2>
                    
                        @foreach($all_product as $key => $product)
                        <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{URL::to('public/uploads/product/'.$product->product_image) }}" alt="" />
                                        <h2>{{number_format($product->product_price).' '.'$'}}</h2>
                                        <p>{{($product->product_content)}}</p>
                                        <a data-url="{{ route('addToCard' , ['id' => $product->product_id]) }}" class="btn btn-default add_to_card"><i class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                    
                    
                                <div class="choose">
                                    <ul class="nav nav-pills">
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

                    <div class="shipping text-center"><!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            {{-- Body Home --}}
          
            {{-- And Body Home --}}
        </div>
    </div>
</section>
<!--features_items-->


@endsection