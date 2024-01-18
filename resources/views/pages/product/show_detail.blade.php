@extends('layout')
@section('content')
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

				<div class="item active">
					<a href=""><img src="{{URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
					<a href=""><img src="{{URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
					<a href=""><img src="{{URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
				</div>

			</div> -->

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
				<div class="col-sm-4">
					<div class="product-image-wrapper">
					<div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image) }}" alt="" />
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
