@extends('layout')
@section('content')
@foreach($product_detail as $key => $value)
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
				<button type="button" class="btn btn-fefault cart">
					<i class="fa fa-shopping-cart"></i>
					Them Gio Hang
				</button>
			</span>
			<p><b>Tinh Trang:</b> Con Hang</p>
			<p><b>Condition:</b> New</p>
			<p><b>Danh Muc:</b> {{$value->category_name}}</p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li class="active"><a href="#reviews" data-toggle="tab">Đánh Giá Sao (5)</a></li>
		</ul>
	</div>
	<div class="tab-content">

		<div class="tab-pane fade " id="details">
			<p>{!!$value->product_desc!!}</p>
		</div>

		<div class="tab-pane fade" id="companyprofile">
			<p>{!!$value->product_content!!}</p>
		</div>


		<div class="tab-pane fade active in" id="reviews">
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>09:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>6 JUN 2024</a></li>
				</ul>
				<style type="text/css">
					.style_comment {
						border: 1px solid #ddd;
						border-radius: 10px;
						background: #f0f0e9;

					}
				</style>
				<form action="">
					@csrf
					<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
					<div id="comment_show"></div>

				</form>
				<!-- Phần Bình Luận -->

				<ul class="list-inline" title="Average Rating">
					@for($count=1; $count<=5; $count++) <?php
						if ($count <= $rating) {
						$color = 'color:#ffcc00;';
						} else {
								$color = 'color:#ccc;';
					    }
						?> <li title="Đánh Giá Sao" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size:30px;">
						&#9733;
						</li>
						@endfor


				</ul>
				 <!-- Phần Đánh Giá Sao -->

				<form action="#">
					<span >
						<input style="width: 100%; margin-left: 0;" type="text" placeholder="Tên Bình Luận" class="comment_name" />
						
					</span>
					<textarea name="comment" class="comment_content" placeholder="Nội Dung Bình Luận"></textarea>
					<div id="notify_comment"></div>
					<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
					<button type="button" class="btn btn-default pull-right  send-comment">
						Gui Bình Luận
					</button>
					
				</form>
			</div>
		</div>

	</div>
</div><!--/category-tab-->
@endforeach


<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản Phẩm Liên Quan</h2>

	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach($relate as $ket => $lienquan)
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
	@endsection