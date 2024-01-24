@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Show List Banner
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-3">
                    <form class="input-group" method="GET" action="{{ route('search-slider') }}" name="myForm1"
                        role="form">
                        <input type="text" class="input-sm form-control" placeholder="Search" name="search_silder"
                            id="searchInput">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </span>
                    </form>
                </div>


            </div>
            <div class="table-responsive">
                {{-- Message hiển thị thông báo active.. --}}
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
                            <th>Slide name</th>
                            <th>Slide image</th>
                            <th>Slide desc</th>
                            <th>Slide status</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Form hiển thị Slider --}}
                        @if (isset($all_slide) && count($all_slide) > 0)
                            @foreach ($all_slide as $key => $slide)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $slide->slider_name }}</td>
                                    <td><img src="public/uploads/slider/{{ $slide->slider_image }}" width="200"
                                            height="80" alt=""></td>
                                    <td>{{ $slide->slider_desc }}</td>

                                    <td><span class="text-ellipsis">
                                            @if ($slide->slider_status == 0)
                                                <a href="{{ '/unactive-slide/' . $slide->id }}">
                                                    <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                                </a>
                                            @else
                                                <a href="{{ '/active-slide/' . $slide->id }}">
                                                    <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                                </a>
                                            @endif
                                        </span></td>

                                    <td>

                                        <a onclick="return confirm('Are you sure to delete?')"
                                            href="{{ URL::to('/delete-slide/' . $slide->id) }}" class="active"
                                            ui-toggle-class="">
                                            <i class="styling-edit fa fa-times text-danger text"></i></a>
                                        </a>
                                    </td>
                                </tr>
                                {{-- END --}}
                            @endforeach
                        @else
                            <h3 class="text-alert " style="color:red; ">No Result </h3>
                        @endif

                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        @if ($all_slide && $all_slide->count() > 0)
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href="{{ $all_slide->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                                </li>

                                @for ($i = 1; $i <= $all_slide->lastPage(); $i++)
                                    <li class="{{ $all_slide->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $all_slide->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li><a href="{{ $all_slide->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        @endif
                    </div>
                </div>
            </footer>
        </div>


    </div>
@endsection
