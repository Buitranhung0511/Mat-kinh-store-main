<?php
use Illuminate\Support\Facades\Session;
?>

<!DOCTYPE html>

<head>
    <title>Đăng nhập Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>

    <style>
        p.text-alert {
            color: red;
        }
    </style>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng nhập </h2>

            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<p class="text-alert ">' . $message . '</p>';
                Session::put('message', null);
            }
            ?>

            <form action="{{ URL::to('/login') }}" method="post">
                {{ csrf_field() }}
                <input type="text" class="ggg" name="admin_email" placeholder="E-MAIL" required="InPut,pls">
                <input type="password" class="ggg" name="admin_password" placeholder="PASSWORD" required="InPut,pls">
                <div style="display: flex; justify-content: space-around">
                    <span><input type="checkbox" />Remember Me</span>
                    <span><a href="#">Forgot Password?</a></span>
                </div>

                <div class="clearfix"></div>
                <input type="submit" value="Đăng Nhập" name="login">
            </form>


            <p>Don't Have an Account ?<a href="{{ url('/register-auth') }}">Create an Auth</a></p>
            {{-- <a href="{{ url('/login-auth') }}">Login an Auth</a> --}}


        </div>
    </div>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
</body>

</html>
