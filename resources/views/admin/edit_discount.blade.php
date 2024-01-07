@extends('admin_layout')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update discount
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        @foreach ($edit_discount as $key => $disc)
                            {{-- Message hiển thị thông báo thêm thành công hay thất bại.. --}}
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                                Session::put('message', null);
                            }
                            ?> <br>
                            {{-- End Message --}}
                            <form role="form" action="{{ URL::to('/update-discount/' . $disc->discount_id) }}"
                                method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount percent</label>
                                    <input type="text" class="form-control" name="discount_percent"
                                        id="exampleInputEmail1" value="{{ $disc->discount_percent }}" required>
                                </div>

                                <button type="submit" name="add-discount" class="btn btn-info ">Update</button>
                                <button type="cancel" name="cancel-product" class="btn btn-warning ">Cancel</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
