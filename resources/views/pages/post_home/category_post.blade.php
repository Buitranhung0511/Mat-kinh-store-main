@extends('layout')
@section('content')
    <div class="container">
        <h2 class="title text-center">Category News</h2>

        <div class="row ">
            {{-- <div class="product-image-wrapper"> --}}
            <div style=" display: flex; flex-wrap: wrap; justify-content: space-between;">
                @foreach ($post as $key => $post)
                    <div class="col-sm-4"
                        style="flex: 0 0 calc(33.3333% - 20px); margin-bottom: 20px; border: 1px solid #ffcccc;
                box-shadow: 0px 0px 3px 3px rgba(107, 212, 203, 0.623); border-radius: 20px">

                        <img style="float: left; width: 100%; height: 300px; padding: 10px"
                            src="{{ URL::to('public/uploads/product/' . $post->post_image) }}"
                            alt="{{ $post->post_title }}" />

                        <div style="flex-grow: 1; padding: 10px; ">
                            <h1>{!! $post->post_title !!}</h1>
                            <p>{!! $post->post_desc !!}</p>
                        </div>

                    </div>

                    {{-- <div class="clearfix"></div> --}}
                @endforeach
            </div>
            {{-- </div> --}}
        </div>

    </div><!--features_items-->
@endsection
