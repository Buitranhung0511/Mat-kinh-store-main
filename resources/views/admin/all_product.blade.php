<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin_layout')
@section('admin-content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Show List Product
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            {{-- Message hiển thị thông báo active --}}
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                Session::put('message', null);
            }
            ?>
            {{-- End Message --}}

            {{-- Message hiển thị thông báo unactive --}}
            <?php
            $message1 = Session::get('message1');
            if ($message1) {
                echo '<p class="text-alert " style="color:red; ">' . $message1 . '</p>';
                Session::put('message1', null);
            }
            ?>
            {{-- End Message --}}
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Product name</th>
                        <th>Product price</th>
                        <th>Product image</th>
                        <th>Product category</th>
                        <th>Show/Hiden</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_product as $key => $pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $pro->product_name }}</td>

                        <td>{{ $pro->product_price }}</td>

                        <td><img src="public/uploads/product/{{ $pro->product_image }}" width="100" height="100" alt=""></td>

                        <td>{{ $pro->category_name }}</td>

                        <td><span class="text-ellipsis">
                                @if ($pro->product_status == 0)
                                <a href="{{ '/unactive-product/' . $pro->product_id }}">
                                    <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                </a>
                                @else
                                <a href="{{ '/active-product/' . $pro->product_id }}">
                                    <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                </a>
                                @endif
                            </span></td>

                        <td>
                            <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}" class="active" ui-toggle-class="">
                                <i class="styling-edit fa fa-pencil-square-o text-success text-active"></i>
                            </a>

                            <a onclick="return confirm('Are you sure to delete?')" href="{{ URL::to('/delete-product/' . $pro->product_id) }}" class="active" ui-toggle-class="">
                                <i class="styling-edit fa fa-times text-danger text"></i></a>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection