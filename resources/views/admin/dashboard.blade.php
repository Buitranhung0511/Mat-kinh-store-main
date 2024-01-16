@extends('admin_layout')
@section('admin_content')
    <h3>Wellcome to Admin</h3>
    <div>
        {{-- <h2>Sản phẩm bán chạy nhất trong tháng:</h2>
        <p>{{ $bestSellingProduct->name }} - {{ $bestSellingProduct->quantity_sold }} sản phẩm bán</p> --}}
    </div>
   
    
    </div>
    <div class="row g-4">
        <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="fact-item bg-light rounded text-center h-100 p-5">
                <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                <p class="mb-2">sản phẩm tồn kho</p>
                <h1 class="display-5 mb-0" data-toggle="counter-up">{{ $stockProducts }}</h1>
      <div class="row">
        <form autocomplete="off" id="filterForm">
            @csrf
            <p>Từ ngày: <input type="text" id="datepicker"></p>
            <p>Đến ngày: <input type="text" id="datepicker2"></p>
        
            <button class="btn" id="btn_dashboard_filter">Filter</button>
        </form>
      </div>
      <div class="container">
        <div id="myfirstchart" style="height: 250px"></div>
      </div>
          
@endsection

