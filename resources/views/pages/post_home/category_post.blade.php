@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center">Category News</h2>


        <div class="product-image-wrapper">
            @foreach ($post as $key => $post)
                <div class="row " style="margin: 0 100px">
                    <div class=" col-sm ">
                        <img style="float: left;width: 15%;height: 150px; padding: 10px"
                            src="{{ URL::to('public/uploads/product/' . $post->post_image) }}"
                            alt="{{ $post->post_title }}" />

                        <h1>{!! $post->post_title !!}</h1>
                        <p>{!! $post->post_desc !!}</p>
                        {{-- <div class="text-right">
                            <a href="" class="btn btn-default btn-lm">Đọc tiếp</a>
                        </div> --}}
                    </div>

                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>

    </div><!--features_items-->
@endsection
