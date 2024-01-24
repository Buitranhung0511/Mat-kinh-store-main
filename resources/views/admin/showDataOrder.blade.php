@extends('admin_layout')
@section('admin_content')

 <!-- Content Row -->
 <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Số lượng tồn kho</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stockProducts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            bestSellingProduct</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
     <!-- Filter Form -->

     <div class="col-lg-12">
        <form autocomplete="off" id="filterForm" class="bg-light p-4 rounded">
            @csrf
            <div class="row ">
              <div class="col-lg-3">
                  <label for="datepicker" class="form-label">Từ ngày:</label>
                  <input type="text" id="datepicker" class="form-control">
              </div>
              <div class="col-lg-3">
                  <label for="datepicker2" class="form-label">Đến ngày:</label>
                  <input type="text" id="datepicker2" class="form-control">
              </div>
              <div class="col-lg-3">
                <label for="datepicker2" class="form-label">Lọc:</label>
                <select id="selectOption" class="form-control">
                    <option>====Chọn====</option>

                    <option value="1">Theo ngày</option>
                    <option value="2"> Theo tháng </option>
                    <option value="3">Theo năm</option>
                </select>
            </div>
              <div class="col-lg-3 mt-3">
                
                <button class="btn btn-primary col-6" id="btn_dashboard_filter">Filter</button>
            </div>
          </div>
          
        </form>
    </div>
</div>

    
      <!-- Chart Container -->
      <div class="row mt-4">
        <div class="col-12">
            <div class="bg-light ">
                <div id="myfirstchart" ></div>
            </div>
        </div>
    </div>

</div>
<div class="container mt-5">
    <h2>Best Selling Products</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Product Name</th>
                <th>Total Quantity Sold</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bestSellingProducts as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->total_quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection