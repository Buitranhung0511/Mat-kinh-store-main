@extends('admin_layout')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update category
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

                        @foreach ($edit_category_product as $key => $edit_value)
                            <form role="form" action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}"
                                method="post">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category name :</label>
                                    <input type="text" class="form-control" name="category_product_name"
                                        id="exampleInputEmail1" value="{{ $edit_value->category_name }}"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discription</label>
                                    <textarea style='resize: none;' rows='8' class="form-control" name="category_product_desc"
                                        id="exampleInputPassword1">{{ $edit_value->category_desc }}</textarea>

                                </div>



                                <button type="submit" name="update-category-product" class="btn btn-info ">Update</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
    </div>
    </div>
@endsection
