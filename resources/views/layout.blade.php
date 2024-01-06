<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.min copy.css') }}" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> --}}


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head><!--/head-->

<body>
    <header id="header" ><!--header-->
        <div class="header_top  "><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{ asset('frontend/images/logo.png') }}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="">
                                <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{ route('cartDetail') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }} " class="active">Trang Chu</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                        <li><a href="product-details.html">Product Details</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li><a href="404.html">Giỏ Hàng</a></li>
                                <li><a href="contact-us.html">liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search" />
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

   


   
  
        <div class="container">
            @yield('content')

        </div>
    <footer id="footer"><!--Footer-->
        <div class="footer-top ">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7 d-flex">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images/iframe1.png') }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images/iframe2.png') }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images/iframe3.png') }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images/iframe4.png') }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer><!--/Footer-->



    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  
  <!-- 
      RTL version
  -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
  <Script>
    function calculateTotalQuantity(data) {
        let totalQuantity = 0;
    
        if (data && Array.isArray(data.items)) {
            // Trường hợp 1: Nếu data chứa một trường là mảng (ví dụ: items)
            data.items.forEach(item => {
                totalQuantity +=  parseInt(item.quantity);
            });
        } else if (typeof data === 'object') {
            // Trường hợp 2: Nếu cần duyệt qua các giá trị của đối tượng
            Object.values(data).forEach(item => {
                totalQuantity +=  parseInt(item.quantity); // Giả sử mỗi item là một đối tượng có trường 'quantity'
            });
        } else {
            console.log("Dữ liệu không hợp lệ");
            return;
        }
    
        // Cập nhật nội dung HTML
        $('#total-quantity').html(totalQuantity);
    }
    
    
    
       $(document).ready(function () {
        
    
         function addToCard(event){
        event.preventDefault();
        let urlProduct = $(this).data('url');
    
    $.ajax({
        type: "GET",
        dataType: "json",
        url: urlProduct,
        success: function (response) {
    if(response.code ===200){
        // alertify.notify( message, 'success', [wait, callback]);
      alertify.success('Success Addcart');
      // parse json 
      calculateTotalQuantity(response.data);
      
    
    
    }        
        }, 
        error:function(){
    
        }
    
        
    });
    
    }
           
    $('.add_to_card').on('click',addToCard);
    
    
    // Function to update the cart
    function upDateCart(id, quantity) {
        let urlUpdateCart = $('.cart_wapper .update_cart_url').data('url');
    
        // Your AJAX request
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: urlUpdateCart,
            data: { id: id, quantity: quantity },
            success: function(response) {
                if (response.code === 200) {
                    $('.cart_wapper').html(response.cart_Component);
                    console.log(response.data);
      calculateTotalQuantity(response.data);
    
                }
            },
            error: function() {
                // Handle errors here
            }
        });
    }
    function deleteCartById(id){
        let urlUpdateCart = $('.cart_wapper .delete_cart_url').data('url');
    
    // Your AJAX request
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlUpdateCart,
        data: { id: id},
        success: function(response) {
            console.log(response);
            if (response.code === 200) {
                 $('.cart_wapper').html(response.cart_Component);
      calculateTotalQuantity(response.data);
    
            }
        },
        error: function() {
            // Handle errors here
        }
    });
    }
    //update Cart 
    $('.cart_wapper').on('click', '.cart-edit', function(event) {
        event.preventDefault();
        
        // Retrieve id and quantity
        let id = $(this).data('id');
        let quantity = $('.cart_wapper #' + id).val();
    
        // Call the upDateCart function with id and quantity
        upDateCart(id, quantity);
    });
    //delet cart
    $('.cart_wapper').on('click', '.cart-delete', function(event) {
        event.preventDefault();
        
        // Retrieve id and quantity
        let id = $(this).data('id');
        
    
        // Call the upDateCart function with id and quantity
        deleteCartById(id);
    });
    function getValueInput() {
        var values = {
            fullname: $("#inputFullname").val(),
            phone: $("#inputPhone").val(),
            email: $("#inputEmail").val(),
            address: $("#inputAddress").val(),
            city: $("#citySelect").val(),
            house: $("#inputHause").val(),
            postalCode: $("#postalCodeInput").val(),
            zip: $("#zipInput").val(),
            checkbox1: $("#flexCheckDefault").prop("checked"),
            checkbox2: $("#flexCheckDefault1").prop("checked")
        };
    
        return values;
    }
    function validateForm(values) {
        // Validate Fullname
        if ($.trim(values.fullname) === '') {
            alert("Please fill in the Fullname field");
            return false;
        }
    
        // Validate Phone
        if ($.trim(values.phone) === '') {
            alert("Please fill in the Phone field");
            return false;
        }
    
        // Validate Email
        if ($.trim(values.email) === '') {
            alert("Please fill in the Email field");
            return false;
        }
    
        // Validate Address
        if ($.trim(values.address) === '') {
            alert("Please fill in the Address field");
            return false;
        }
    
        // Validate City
        if ($.trim(values.city) === '') {
            alert("Please select a City");
            return false;
        }
    
        // Validate House
        if ($.trim(values.house) === '') {
            alert("Please fill in the House field");
            return false;
        }
    
        // Validate Postal Code
        if ($.trim(values.postalCode) === '') {
            alert("Please fill in the Postal Code field");
            return false;
        }
    
        // Validate Zip
        if ($.trim(values.zip) === '') {
            alert("Please fill in the Zip field");
            return false;
        }
    
        // Validate Checkbox 1
        if (!values.checkbox1) {
            alert("Please check Checkbox 1");
            return false;
        }
    
        // Validate Checkbox 2
        if (!values.checkbox2) {
            alert("Please check Checkbox 2");
            return false;
        }
    
        // You can add more validation rules as needed
    
        return true;
    }function setModalFields(nameProduct, quantity, subtotal, nameUser,email,phone, address,house,postalCode,zip) {
        $('#nameProduct').val(nameProduct);
        $('#quantity').val(quantity);
       
    
        $('#subtotal').val(subtotal);
        $('#nameUser').val(nameUser);
        $('#phoneUser').val(phone);
        $('#emailUser').val(email);
        $('#address').val(address + ', ' + house + ', ' + postalCode + ', ' + zip);
    
      }
      function openModal(data) {
        // Set modal fields with the provided data
        setModalFields(data.product, data.quantity, data.subtotal, data.fullname,data.email,data.phone, data.address,data.house,data.postalCode,data.zip);
    
        // Show the modal
        $('#myModal').modal('show');
      }
      $('#showModalButton').on('click', function () {
        let data = getValueInput();
       if(validateForm(data)){
       let url = 'http://127.0.0.1:8000/data_user'
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: url,
            data: data,
            success: function(response) {
                if (response.code === 200) {
                    console.log(response);
                  
                     openModal(data);
                   
                }
            },
            error: function() {
                // Handle errors here
            }
        });
    
    
       }
        });
    
      //get value checkked
      $('#submitButton').click(function() {
          var selectedPaymentMethod = $('input[name="paymentMethod"]:checked').val();
          if (selectedPaymentMethod !== undefined) {
    
           switch (selectedPaymentMethod) {
    
            case '1':
            $('#vn_payment').click();
                
                break;
                case '2':
                $('#vn_momo').click();
                
                break;
           
            default:
                break;
           }
          } else {
            console.log('Please select a payment method');
          }
        });
     
    
    
    });
    
    
         </Script>
</body>

<script type="text/javascript">
    function remove_background(product_id){
        for(var count = 1; count <=5; count++){
            $('#'+product_id+'-'+count).css('color','#ccc');
        }
    }

  // hover chuột đánh giá sao
  $(document).on('mouseenter','.rating',function() {
    var index =$(this).data("index");
    var product_id = $(this).data('product_id');

    remove_background(product_id);

    for(var count =1; cpunt<=index;count++){
        $('#'+product_id+'-'+count).css('color','#ffcc00');
    }
  }); 

  //nhả chuột không đánh giá sao
  $(document).on('mouseleave','.rating', function(){
    var index = $(this).data("index");
    var product_id = $(this).data('product_id');
    var rating = $(this).data("rating");
    remove_background(product_id);
    for (var count = 1; count <=rating; count++) {
        $('#'+product_id+'-'+count).css('color','#ffcc00');
    }
  });

  //click đánh giá sao
  $(document).on('click','.rating',function(){
    var index =$(this).data("index");
    var product_id = $(this).data('product_id');
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url:"{{url('insert-rating')}}",
        method:"POST",
        data:{index:index, product_id:product_id,_token:_token},
        success:function(data){
            if(data== 'done'){
                alert("Bạn Đã Đánh Giá"+index+"trên 5 ");
            }else{
                alert("LỖI: Không thể đánh giá");
            }
        }
    });
  });

</script>


</html>