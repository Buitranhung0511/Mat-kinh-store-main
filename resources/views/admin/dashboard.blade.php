@extends('admin_layout')
@section('admin_content')
    <h3>Wellcome to Admin</h3>
    <div>
        {{-- <h2>Sản phẩm bán chạy nhất trong tháng:</h2>
        <p>{{ $bestSellingProduct->name }} - {{ $bestSellingProduct->quantity_sold }} sản phẩm bán</p> --}}
    </div>
   
    <div class="card border-0 shadow-lg rounded" style="background: linear-gradient(to right, #56CCF2, #2F80ED);">
        <div class="card-header bg-transparent border-0 text-white">
            <h2 class="mb-0">Số lượng sản phẩm tồn kho trong tháng:</h2>
        </div>
        <div class="card-body">
            <p class="lead text-white">{{ $stockProducts }} sản phẩm tồn kho</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="fact-item bg-light rounded text-center h-100 p-5">
                <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                <p class="mb-2">sản phẩm tồn kho</p>
                <h1 class="display-5 mb-0" data-toggle="counter-up">{{ $stockProducts }}</h1>
            </div>
        </div>
          
@endsection
