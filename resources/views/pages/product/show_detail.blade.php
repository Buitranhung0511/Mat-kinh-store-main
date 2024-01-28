@extends('layout')
@section('content')
    @foreach ($product_detail as $key => $value)
        <div class="product-details container"><!--product-details-->

            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ URL::to('/public/uploads/product/' . $value->product_image) }}" alt="" />
                    <h3>ZOOM</h3>
                </div>

                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information">
                    {{-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> --}}

                    <h1 class="my-3"> Product name :{{ $value->product_name }}</h1>
                    <img src="images/product-details/rating.png" alt="" />


                    <div class="row mt-3 align-items-center">
                        <!-- Price -->
                        <div class="col-2">
                            <label class="form-label d-block" style="font-size: 15px">Price:</label>
                            <p class="h3">{{ number_format($value->product_price) }}</p>
                        </div>

                        <div class="col-1">
                            <!-- Spacer with '*' -->
                            <p class="h3 mt-5">*</p>
                        </div>
                        {{-- luongth --}}

                        <!-- Quantity -->
                        <div class="col-2">
                            <label for="{{ $id }}" class="form-label d-block"
                                style="font-size: 15px">Quantity:</label>
                            <input id="{{ $id }}" min="1" name="quantity" value="1" max="10"
                                type="number" class="form-control form-control-sm"
                                style="width: 60px; display: inline-block; font-size: 16px;" />
                        </div>
                    </div>



                    <div class="mt-3">
                        <a data-id="{{ $id }}" class="btn btn-warning cart_edit update_cart_url"
                            data-url="{{ route('updateCart') }}">
                            <i class="fa fa-shopping-cart"></i> Add to cart
                        </a>
                    </div>

                    <h3 class="mt-3"><b style="color: rgb(92, 188, 225);">Status:</b> Con Hang</h3>
                    <h3><b style="color: rgb(92, 188, 225);">Condition:</b> New</h3>
                    {{-- <h3><b style="color: rgb(92, 188, 225);">Category:</b> {{ $value->category_id }}</h3> --}}
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                            alt="" /></a>
                </div>
            </div>
        </div><!--/product-details-->


        <div class="category-tab shop-details-tab container"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Product description</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Product Details</a></li>
                    <li><a href="#reviews" data-toggle="tab">Star Rating....... (5)</a></li>
                </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane active in" id="details">
                    <h3>{!! $value->product_desc !!}</h3>
                </div>

                <div class="tab-pane " id="companyprofile">
                    <h4>{!! $value->product_content !!}</h4>
                </div>


                <div class="tab-pane" id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>

                        <style class="text/css">
                            .row.style-comment {
                                border: 1px solid #ddd;
                                border-radius: 10px;
                                background: #f0f0ef;
                            }
                        </style>
                        <input type="hidden" class="product_id" value="{{ $value->product_id }}">


                        <div id="comment_show"></div>

                        <h3>Write your comment</h3>
                        <ul class="list-inline" title="Average Rating">
                            @for ($count = 1; $count <= 5; $count++)
                                @php $color=($count <=$rating) ? 'color:#ffcc00;' : 'color:#ccc;' ; @endphp
                                <li title="Đánh Giá Sao" id="{{ $value->product_id }}-{{ $count }}"
                                    data-index="{{ $count }}" data-product-id="{{ $value->product_id }}"
                                    data-rating="{{ $rating }}" class="rating"
                                    style="cursor:pointer; {{ $color }} font-size:30px;">
                                    &#9733;
                                </li>
                            @endfor
                        </ul>

                        <form action="#">

                            <span>
                                <input class="comment_name" type="text" placeholder="Your Name" />
                                <input class="comment_email" type="email" placeholder="Email Address" />
                            </span>
                            <textarea name="comment" class="comment_content" style="font-size: 20px"></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" />
                            <button type="button" class="btn btn-default pull-right send-comment">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    @endforeach
@endsection
