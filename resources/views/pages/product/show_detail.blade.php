@extends('layout')
@section('content')
<<<<<<< HEAD
    @foreach ($product_detail as $key => $value)
        <div class="product-details container"><!--product-details-->

            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ URL::to('/public/uploads/product/' . $value->product_image) }}" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    {{-- <!-- <div class="carousel-inner">
=======
@foreach($product_detail as $key => $value)
<div class="container">
	<div class="product-details"><!--product-details-->
		<div class="col-sm-5">
			<div class="view-product">
				<img src="{{ URL::to('/public/uploads/product/'.$value->product_image) }}" alt="" />
				<h3>ZOOM</h3>
			</div>
			<div id="similar-product" class="carousel slide" data-ride="carousel">

				<!-- Wrapper for slides -->
				<!-- <div class="carousel-inner">
>>>>>>> 9c735972c689d92533ceabb863e55a922c0aaa2f

				<div class="item active">
					<a href=""><img src="{{URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
					<a href=""><img src="{{URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
					<a href=""><img src="{{URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
				</div>

			</div> --> --}}

<<<<<<< HEAD
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
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $value->product_name }}</h2>
                    <img src="images/product-details/rating.png" alt="" />
                    <span>
                        <span>{{ number_format($value->product_price) . '$' }}</span>
                        <label>Quantity:</label>
                        <input type="number" min="1" value="1" />
                        <a data-url="{{ route('addToCard', ['id' => $value->product_id]) }}"
                            class="btn btn-default add_to_card">
                            <i class="fa fa-shopping-cart"></i>Add to cart
                        </a>
                    </span>
                    <p><b>Tinh Trang:</b> Con Hang</p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Danh Muc:</b> {{ $value->category_id }}</p>
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                            alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->


        <div class="category-tab shop-details-tab container"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                    <li><a href="#reviews" data-toggle="tab">Đánh Giá Sao (5)</a></li>
                </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane active in" id="details">
                    <p>{!! $value->product_desc !!}</p>
                </div>

                <div class="tab-pane " id="companyprofile">
                    <p>{!! $value->product_content !!}</p>
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

                        <p><b>Viet Danh Gia</b></p>
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
                            <textarea name="comment" class="comment_content"></textarea>
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


    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản Phẩm Liên Quan</h2>

        {{-- <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach ($relate as $ket => $lienquan)
=======
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
			<div class="product-information"><!--/product-information-->
				<img src="images/product-details/new.jpg" class="newarrival" alt="" />
				<h2>{{$value->product_name}}</h2>
				<p>ID: {{$value->product_id}}</p>
				<img src="images/product-details/rating.png" alt="" />
				<span>
					<span>{{number_format($value->product_price).'$'}}</span>
					<label>Quantity:</label>
					<input type="number" min="1" value="1" />
					<a data-url="{{ route('addToCard' , ['id' => $value->product_id]) }}" class="btn btn-default add_to_card"><i class="fa fa-shopping-cart"></i>Add to
						cart</a>
				</span>
				<p><b>Tinh Trang:</b> Con Hang</p>
				<p><b>Condition:</b> New</p>
				<p><b>Danh Muc:</b> {{$value->product_name}}</p>
				<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->


	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
				<li class="active"><a href="#reviews" data-toggle="tab" class="send-comment">Đánh Giá Sao (5)</a></li>
			</ul>
		</div>
		<div class="tab-content">

	 <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach($category  as $ket => $lienquan)
>>>>>>> 9c735972c689d92533ceabb863e55a922c0aaa2f
				<div class="col-sm-4">
					<div class="product-image-wrapper">
					<div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image) }}" alt="" />
<<<<<<< HEAD
	<h2>{{number_format($lienquan->product_price).' '.'$'}}</h2>
	<p>{{($lienquan ->product_name)}}</p>
	<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
		cart</a>
</div>
</div>
</div>
</div>
@endforeach

</div>
<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
	<i class="fa fa-angle-left"></i>
</a>
<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
	<i class="fa fa-angle-right"></i>
</a>
</div>
</div><!--/recommended_items--> --}}
    @endsection
=======
                        <h2>{{number_format($lienquan->product_price).' '.'$'}}</h2>
                        <p>{{($lienquan ->product_name)}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                </div>
					</div>
					@endforeach

				</div>
				<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div><!--/recommended_items-->
	</div>
</div>
@endforeach

@endsection
>>>>>>> 9c735972c689d92533ceabb863e55a922c0aaa2f
