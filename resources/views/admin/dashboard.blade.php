@extends('admin_layout')
@section('admin-content')
    <h3>Wellcome to Admin</h3>
    {{-- <div>
        {{-- <h2>Sản phẩm bán chạy nhất trong tháng:</h2>
        <p>{{ $bestSellingProduct->name }} - {{ $bestSellingProduct->quantity_sold }} sản phẩm bán</p> --}}
    </div>
   
    
    </div>
    <div class="container my-4">
      <div class="row g-4">
          <!-- Product Stock Card -->
          <div class="col-lg-3 col-md-6">
              <div class="card text-center bg-light">
                  <div class="card-body">
                      <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                      <p class="card-text mb-2">Sản phẩm tồn kho</p>
                      <h1 class="display-5 mb-0" data-toggle="counter-up">{{ $totalStock }}</h1>
                  </div>
              </div>
         
          </div>
  
      </div>
  
      <!-- Chart Container -->
      <div class="row mt-4">
          <div class="col">
              <div class="bg-light p-4 rounded">
                  <div id="myfirstchart" style="height: 250px"></div>
              </div>
          </div>
      </div>
  </div>
  
      
      <canvas id="doughnutChart"></canvas>

          
@endsection


