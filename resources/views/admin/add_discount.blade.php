<?php
use Illuminate\Support\Facades\Session;
?>
@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add discount
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        {{-- Message hiển thị thông báo thêm thành công hay thất bại --}}
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                            Session::put('message', null);
                        }
                        ?> <br>
                        {{-- End Message .. --}}
                        <form name="myForm1" role="form" action="{{ URL::to('/save-discount') }}" method="post"
                            enctype="multipart/form-data" onsubmit="return validateForm('myForm1')">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount_name</label>
                                <input type="text" class="form-control" name="discount_name" id="exampleInputEmail1"
                                    data-validation="length" data-validation-length = "min3">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount_code</label>
                                <input type="text" class="form-control" name="discount_code" id="exampleInputEmail1">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount_percent</label>
                                <input type="text" class="form-control" name="discount_percent" id="exampleInputEmail1"
                                    placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Discount_status</label>
                                <select name="discount_status" class="form-control input-sm m-bot15 ">
                                    <option value="1">Hiden</option>
                                    <option value="0">Show</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Start_date</label>
                                <input type="text" name="start_date" id="date" class="form-control"
                                    data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">End_date</label>
                                <input type="text" name="end_date" id="date" class="form-control"
                                    data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            </div>

                            {{-- <div class="form-group">
                                <label for="exampleInputPassword1">Category : </label>
                                <select name="product_cate" class="form-control input-sm m-bot15 ">

                                    @foreach ($cate_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach


                                </select>
                            </div> --}}




                            <button type="submit" name="add-product" class="btn btn-info ">Add</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    </div>
    </div>
@endsection
