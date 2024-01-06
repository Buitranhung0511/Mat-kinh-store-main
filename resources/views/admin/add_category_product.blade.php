@extends('admin_layout')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add category product
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
                        ?>
                        {{-- End Message --}}
                        <form role="form" action="{{ URL::to('/save-category-product') }}" method="post" name="myForm1"
                            onsubmit="return validateForm('myForm1')">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category name :</label>
                                <input type="text" class="form-control" name="category_product_name"
                                    id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Discription</label>
                                <textarea style='resize: none;' rows='8' class="form-control" name="category_product_desc" id="editor3"
                                    placeholder="Category discriptions">
                                                        </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Show</label>
                                <select name="category_product_status" class="form-control input-sm m-bot15 ">
                                    <option value="0">Hiden</option>
                                    <option value="1">Show</option>
                                </select>
                            </div>


                            <button type="submit" name="add-category-product" class="btn btn-info ">Add</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    </div>
    </div>
@endsection
