<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>

<head>
    <title>DashBoard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Custom CSS.. -->
    <link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('backend/js/morris.js') }}"></script>

    <style>
        span.fa-thumb-styling.fa.fa-thumbs-down {
            font-size: 25px;
            color: red;
        }

        span.fa-thumb-styling.fa.fa-thumbs-up {
            font-size: 25px;
            color: green;
        }

        i.styling-edit {
            font-size: 25px
        } 
    </style>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ 'backend/images/2.png' }}">

                            <span class="username">

                                <?php
                                $name = Auth::user()->admin_name;
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/logout-auth') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ URL::to('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Banner</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-slider/') }}">Add slider</a></li>
                                <li><a href="{{ URL::to('/manage-slider/') }}">Show slider list</a></li>
                            </ul>
                        </li>


           
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Category products list</span>
                                <span>Category products</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-category-product/') }}">Add Category product</a></li>
                                <li><a href="{{ URL::to('/all-category-product/') }}">Show Category list</a></li>
                            </ul>
                        </li>
                        {{-- End --}}

                        {{-- Product Dashboard --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Products list</span>
                                <span>Products</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-product/') }}">Add product</a></li>
                                <li><a href="{{ URL::to('/all-product/') }}">Show product list</a></li>
                            </ul>
                        </li>
                        {{-- End --}}

                        {{-- Member Dashboard --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Member</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/register-member/') }}">Register Member</a></li>
                                <li><a href="{{ URL::to('/all-member/') }}">Show member list</a></li>
                            </ul>
                        </li>
                        {{-- End --}}

                        {{-- Order Dashboard --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Order</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/view-order/') }}">Manage Order</a></li>

                            </ul>
                        </li>
                        {{-- End --}}

                        {{-- Discount Dashboard --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Discount</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-discount/') }}">Add discount</a></li>
                                <li><a href="{{ URL::to('/all-discount/') }}">Show discount list</a></li>
                            </ul>
                        </li>
                        {{-- End --}}

                        {{-- Comment Dashboard --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Comment</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/all-comment/') }}">Show commnet list</a></li>
                            </ul>
                        </li>
                        {{-- End --}}


                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">


            <!-- Phan Body -->
            <section class="wrapper">

                @yield('admin_content')
              
            </section>
            <!-- Phan Body -->


            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2023 Vietnam. All rights reserved | Design by HTL</p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    {{-- <script src="{{ asset('backend/ckeditor5-build-classic/ckeditor.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
   {{-- luongth functions order --}}

   <script  type="application/x-javascript">
    $( function() {
        
      $( "#datepicker" ).datepicker({


        dateFormat:"yy-mm-dd"
      });
      $( "#datepicker2" ).datepicker({


dateFormat:"yy-mm-dd"
});
    } );
    </script>

<script>
    $(document).ready(function () {

 var chart = new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  barColors: ['#00a65a', '#32c5d2', '#5cb85c', '#8cc152'],
 parseTime:false,
 hideHover:'auto',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  
  // The name of the data record attribute that contains x-values.
  xkey: 'perifod',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['order','sales','profit','quantity'],
  // Labels for the ykeys -- will be displayed when you hover over the
  labels:['đơn hàng','doanh số','lợi nhuận','số lượng']
  // chart.
});

        $('#filterForm').submit(function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Your AJAX request code goes here
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();

            $.ajax({
                type: 'GET',
                url: '/filter_by_date', // Replace with the actual endpoint URL
                data: {
                    // _token: _token,
                    from_date: from_date,
                    to_date: to_date
                },
                success: function (response) {
                    console.log(response);
                   chart.setData(response);
                },
                error: function (error) {
                    console.error(error);
                    // Handle the error or show a message to the user
                }
            });
        });
    });
</script>

    {{-- script tìm kiếm sản phẩm --}}

    {{-- <script src="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        new DataTable('#example', {
            search: {
                return: true
            }
        });
    </script> --}}

    <!-- Khởi tạo CKEditor cho textarea có id là 'editor' -->
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                // console.log('Editor was initialized', editor);
            })
            .catch(error => {
                // console.error('There was an error initializing the editor:', error);
            });

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor2 => {
                // console.log('Editor was initialized', editor);
            })
            .catch(error => {
                // console.error('There was an error initializing the editor:', error);
            });

        ClassicEditor
            .create(document.querySelector('#editor3'))
            .then(editor3 => {
                // console.log('Editor was initialized', editor);
            })
            .catch(error => {
                // console.error('There was an error initializing the editor:', error);
            });
    </script>

    {{-- Đoạn script check validate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.6.0/validator.min.js"></script>
    <script>
        function validateForm(formName) {
            var form = document.forms[formName];
            var inputs = form.getElementsByTagName('input');

            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                var value = input.value.trim();
                var label = input.getAttribute('name'); // Lấy tên trường input làm nhãn

                // Kiểm tra xem trường input có giá trị không

                if (!label || label === "null") {
                    console.error("Trường input không hợp lệ: ", input);
                    continue;
                }

                //    console.log('input name ', label);
                //    console.log('input value ', value);
                // Ghi thông tin ra console
                console.log("Tên trường input:", label);
                console.log("Giá trị của trường input:", value);

                // Kiểm tra xem trường input có thuộc tính name hợp lệ không
                if (!label || label === "null") {
                    console.error("Trường input không hợp lệ: ", input);
                    continue; // Bỏ qua và chuyển sang trường input tiếp theo
                }

                // Kiểm tra xem trường input có giá trị không
                if (validator.isEmpty(value)) {
                    alert("Vui lòng nhập " + label);
                    return false;
                }


                // Thêm các điều kiện kiểm tra khác tại đây
            }

            return true;
        }
    </script>




    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
    <!-- morris JavaScript -->



    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }
            
           
            // graphArea2 = Morris.Area({
            //     element: 'hero-area',
            //     padding: 10,
            //     behaveLikeLine: true,
            //     gridEnabled: false,
            //     gridLineColor: '#dddddd',
            //     axes: true,
            //     resize: true,
            //     smooth: true,
            //     pointSize: 0,
            //     lineWidth: 0,
            //     fillOpacity: 0.85,
            //     data: [{
            //             period: '2015 Q1',
            //             iphone: 2668,
            //             ipad: null,
            //             itouch: 2649
            //         },
            //         {
            //             period: '2015 Q2',
            //             iphone: 15780,
            //             ipad: 13799,
            //             itouch: 12051
            //         },
            //         {
            //             period: '2015 Q3',
            //             iphone: 12920,
            //             ipad: 10975,
            //             itouch: 9910
            //         },
            //         {
            //             period: '2015 Q4',
            //             iphone: 8770,
            //             ipad: 6600,
            //             itouch: 6695
            //         },
            //         {
            //             period: '2016 Q1',
            //             iphone: 10820,
            //             ipad: 10924,
            //             itouch: 12300
            //         },
            //         {
            //             period: '2016 Q2',
            //             iphone: 9680,
            //             ipad: 9010,
            //             itouch: 7891
            //         },
            //         {
            //             period: '2016 Q3',
            //             iphone: 4830,
            //             ipad: 3805,
            //             itouch: 1598
            //         },
            //         {
            //             period: '2016 Q4',
            //             iphone: 15083,
            //             ipad: 8977,
            //             itouch: 5185
            //         },
            //         {
            //             period: '2017 Q1',
            //             iphone: 10697,
            //             ipad: 4470,
            //             itouch: 2038
            //         },

            //     ],
            //     lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
            //     xkey: 'period',
            //     redraw: true,
            //     ykeys: ['iphone', 'ipad', 'itouch'],
            //     labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            //     pointSize: 2,
            //     hideHover: 'auto',
            //     resize: true
            // });
        

    });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('/backend/js/monthly.js') }}"></script>
    <script type="text/javascript">
        $(window).on(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->
</body>


</html>
