@extends('admin_layout')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Slider
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
                        {{-- End Message.. --}}
                        <form name="myForm1" role="form" action="{{ URL::to('/insert-slider') }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return validateForm('myForm1')">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slide name :</label>
                                <input type="text" class="form-control" name="slider_name" id="exampleInputEmail1"
                                    data-validation="length" data-validation-length = "min3">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Slide image :</label>
                                <input type="file" class="form-control" name="slider_image" id="exampleInputEmail1">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Slide Discription</label>
                                <textarea style='resize: none;' id="editor" rows='8' class="form-control" name="slider_desc">
                                                        </textarea>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Show</label>
                                <select name="slider_status" class="form-control input-sm m-bot15 ">
                                    <option value="1">Hiden</option>
                                    <option value="0">Show</option>
                                </select>
                            </div>


                            <button type="submit" name="add-slider" class="btn btn-info ">Add Slider</button>

                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
