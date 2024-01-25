<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\HistoryController;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\sliderController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// FRONT-END
Route::get('/', [
    HomeController::class, 'index'
])->name('home');

Route::get('/trang-chu', [
    HomeController::class, 'index'
])->name('home');

Route::get('/san-pham', [
    HomeController::class, 'product'
])->name('product');
Route::get('/contact', [
    HomeController::class, 'getContact'
])->name('contact');



//Danh mục sản phẩm - Trang Chủ "Hung"============
Route::get('/danh-muc-san-pham/{category_id}', [
    CategoryProductController::class, 'show_category_home'
])->name('home');

Route::get('/chi-tiet-san-pham/{product_id}', [
    ProductController::class, 'detail_product'
])->name('home');

//Đánh giá sao
Route::get('/insert-rating', [
    ProductController::class, 'insert_rating'
])->name('/insert-rating');

Route::get('/load-comment', [
    ProductController::class, 'load_comment'
])->name('/load_comment');

Route::get('/send-comment', [
    ProductController::class, 'send_comment'
])->name('/send_comment');
//Danh mục sản phẩm - Trang Chủ "Hung"============



// BACK-END..
Route::get('/admin_login', [
    AdminController::class, 'index'
])->name('admin_login');

Route::get('/filter_by_date', [
    AdminController::class, 'filterBydate'
])->name('filter_by_date');


Route::get('/dashboard', [
    AdminController::class, 'show_dashboard'
])->name('dashboard');

//XỬ LÝ LOG_OUT
Route::get('/logout', [
    AdminController::class, 'logout'
])->name('logout');

Route::post('/admin-dashboard', [
    AdminController::class, 'dashboard'
])->name('/admin-dashboard');

// ordersatus
Route::get('/update-order-status', [
    AdminController::class, 'updateOrderStatus'
])->name('/update-order-status');



// luongth check out
// add tocard
Route::get('/product/add-to-card/{id}', [
    CartController::class, 'addToCard'
])->name('addToCard');

//cart detail
Route::get('/cartDetail', [
    CartController::class, 'showCart'
])->name('cartDetail');

//update cart
Route::get('/cart-update', [
    CartController::class, 'upDateCart'
])->name('updateCart');

Route::get('/cart-delete_by_id', [
    CartController::class, 'deleteCartById'
])->name('deleteCart');

// route check out
Route::get('/check_out', [
    CartController::class, 'getTotal'
])->name('check_out');

Route::post('/vn_payment', [
    CheckOutController::class, 'vn_payment'
])->name('vn_payment');

Route::post('/vn_momo', [
    CheckOutController::class, 'vn_momo'
])->name('vn_momo');

Route::post('/vn_onepay', [
    CheckOutController::class, 'vn_onepay'
])->name('vn_onepay');

//route thank History
Route::get('/thank', [
    HistoryController::class, 'index'
])->name('thank');

Route::get('/thank_vn_momo', [
    HistoryController::class, 'insertPaymentVnMomo'
])->name('isert_momo');

Route::get('/thank_vn_pay', [
    HistoryController::class, 'insertPaymentVNpay'
])->name('isert_vn_pay');

Route::get('/data_user', [
    HistoryController::class, 'getDataCheckOut'
])->name('input_data');



//============================================================================

// Hiển thị page home
Route::get('/category-post', [
    CategoryPostController::class, 'category_post'
])->name('category-post');


//=============================================================================
//Authentication roles
Route::get('register-auth', [
    AuthController::class, 'register_auth'
])->name('register-auth');

Route::get('login-auth', [
    AuthController::class, 'login_auth'
])->name('login-auth');

Route::get('logout-auth', [
    AuthController::class, 'logout_auth'
])->name('logout-auth');

Route::post('register', [
    AuthController::class, 'register'
])->name('register');

Route::post('login', [
    AuthController::class, 'login'
])->name('login');

//********************************************************************************************************* */
// CÁC ROUTE DÀNH CHO ADMIN

Route::middleware(['checkAdmin'])->group(function () {
    //========================================================
    // ORDER MANAGEMENT
    Route::get('/view-order', [
        OrderController::class, 'view_order'
    ])->name('view-order');

    Route::post('assign-roles', [
        AuthController::class, 'assign_roles'
    ])->name('assign-roles');

    // Phân quyền chức năng
    Route::post('assign-roles', [
        UserController::class, 'assign_roles'
    ])->name('assign-roles')->middleware('auth.roles');

    // User List
    Route::get('all-user', [
        UserController::class, 'index'
    ])->name('all-user');

    // Add User
    Route::get('add-user', [
        UserController::class, 'add_users'
    ])->name('add-user');
});

//********************************************************************************************************* */
// CÁC ROUTE DÀNH CHO AUTHOR
Route::middleware(['checkAuthor'])->group(function () {

    // SLIDER MANAGEMENT
    Route::get('add-slider', [
        sliderController::class, 'add_slider'
    ])->name('add-slider');

    // Thêm slider
    Route::post('insert-slider', [
        sliderController::class, 'insert_slider'
    ])->name('insert-slider');

    //  Hiden slider
    Route::get('/unactive-slide/{id}', [
        sliderController::class, 'unactive_slide'
    ])->name('unactive-slide');

    //  Show slider
    Route::get('/active-slide/{id}', [
        sliderController::class, 'active_slide'
    ])->name('active-slide');

    // Delete slide
    Route::get('/delete-slide/{id}', [
        sliderController::class, 'delete_slide'
    ])->name('delete-slide');


    //========================================================
    // XỬ LÝ Member (DASHBOARD)

    Route::post('/register-member', [
        MemberController::class, 'store'
    ])->name('register-member');

    Route::get('register-member', [
        MemberController::class, 'create'
    ])->name('register-member');

    Route::get('/all-member', [
        MemberController::class, 'all_member'
    ])->name('all-member');

    // Xử lý trang UPDATE member
    Route::post('/ban-member/{id}', [
        MemberController::class, 'banMember'
    ])->name('ban-member');

    Route::post('/unban-member/{id}', [
        MemberController::class, 'unbanMember'
    ])->name('unban-member');

    Route::get('/search', [
        MemberController::class, 'search'
    ])->name('search');

    //============================================================================
    // XỬ LÝ CATEGORY-PRODUCT (DASHBOARD)
    Route::get('/add-category-product', [
        CategoryProductController::class, 'add_category_product'
    ])->name('add-category-product');

    // Xử lý Hiden/Show của trang all_category_product
    Route::get('/unactive-category-product/{category_product_id}', [
        CategoryProductController::class, 'unactive_category_product'
    ])->name('unactive-category-product');

    // Xử lý Hiden/Show của trang all_category_product
    Route::get('/active-category-product/{category_product_id}', [
        CategoryProductController::class, 'active_category_product'
    ])->name('active-category-product');

    // Xử lý trang UPDATE CATEGORY
    Route::get('/edit-category-product/{category_product_id}', [
        CategoryProductController::class, 'edit_category_product'
    ])->name('edit-category-product');

    Route::post('/update-category-product/{category_product_id}', [
        CategoryProductController::class, 'update_category_product'
    ])->name('update-category-product');

    // Xử lý  Delete CATEGORY
    Route::get('/delete-category-product/{category_product_id}', [
        CategoryProductController::class, 'delete_category_product'
    ])->name('delete-category-product');

    //Save Category
    Route::post('/save-category-product', [
        CategoryProductController::class, 'save_category_product'
    ])->name('save-category-product');


    //===============================================================
    // XỬ LÝ PRODUCT (DASHBOARD)
    Route::get('/add-product', [
        ProductController::class, 'add_product'
    ])->name('add-product');

    // Edit Product
    Route::get('/edit-product/{product_id}', [
        ProductController::class, 'edit_product'
    ])->name('edit-product');

    // Xử lý Hiden/Show của trang product
    Route::get('/unactive-product/{product_id}', [
        ProductController::class, 'unactive_product'
    ])->name('unactive-product');

    // Xử lý Hiden/Show của trang product
    Route::get('/active-product/{product_id}', [
        ProductController::class, 'active_product'
    ])->name('active-product');

    // Xử lý UPDATE Product
    Route::post('/update-product/{product_id}', [
        ProductController::class, 'update_product'
    ])->name('update-product');

    // Xử lý Delete Product
    Route::get('/delete-product/{product_id}', [
        ProductController::class, 'delete_product'
    ])->name('delete-product');

    //Save Prodcut
    Route::post('/save-product', [
        ProductController::class, 'save_product'
    ])->name('save-product');


    //=============================================================================
    // MANAGE DISCOUNT
    Route::get('/add-discount', [
        DiscountController::class, 'add_discount'
    ])->name('add-discount');

    Route::post('/save-discount', [
        DiscountController::class, 'save_discount'
    ])->name('save-discount');

    Route::get('/unactive-discount/{discountt_id}', [
        DiscountController::class, 'unactive_discount'
    ])->name('unactive-discount');

    Route::get('/active-discount/{discount_id}', [
        DiscountController::class, 'active_discount'
    ])->name('active-discount');

    Route::get('/edit-discount/{discount_id}', [
        DiscountController::class, 'edit_discount'
    ])->name('edit-discount');

    Route::post('/update-discount/{discount_id}', [
        DiscountController::class, 'update_discount'
    ])->name('update-discount');

    Route::get('/delete-discount/{discount_id}', [
        DiscountController::class, 'delete_discount'
    ])->name('delete-discount');

    Route::post('/check-discount', [DiscountController::class, 'checkDiscountCode'])->name('check-discount');


    //==================================================================
    // CATEGORY POST CONTROLLER MANAGEMENT
    Route::get('add-category-post', [
        CategoryPostController::class, 'add_category_post'
    ])->name('add-category-post');

    Route::post('/save-category-post', [
        CategoryPostController::class, 'save_category_post'
    ])->name('save-category-post');

    Route::get('unactive-cate-post/{category_posts_id}', [
        CategoryPostController::class, 'unactive_cate_post'
    ])->name('unactive-cate-post');

    Route::get('active-cate-post/{category_posts_id}', [
        CategoryPostController::class, 'active_cate_post'
    ])->name('active-cate-post');

    Route::get('/edit-cate-post/{category_posts_id}', [
        CategoryPostController::class, 'edit_category_post'
    ])->name('edit-cate-post');

    Route::post('/update-cate-post/{category_posts_id}', [
        CategoryPostController::class, 'update_category_post'
    ])->name('update-cate-post');

    Route::get('/delete-cate-post/{category_posts_id}', [
        CategoryPostController::class, 'delete_category_post'
    ])->name('delete-cate-post');

    Route::get('/search-cate-post', [
        CategoryPostController::class, 'search_cate_post'
    ])->name('search-cate-post');

    //==================================================================
    // POST MANAGEMENT
    // Delete Post
    Route::get('/delete-post/{posts_id}', [
        PostController::class, 'delete_post'
    ])->name('delete-post');
});


//********************************************************************************************************* */
// CÁC ROUTE DÀNH CHO USER
Route::middleware(['checkUser'])->group(function () {
    //Show Slider
    Route::get('manage-slider', [
        sliderController::class, 'manage_slider'
    ])->name('manage-slider');

    //Search Sliders
    Route::get('/search-slider', [
        sliderController::class, 'search_slider'
    ])->name('search-slider');

    // ===================================================================
    //Search Category
    Route::get('/search-category-product', [
        CategoryProductController::class, 'search_category_product'
    ])->name('search-category-product');

    // Show Category
    Route::get('/all-category-product', [
        CategoryProductController::class, 'all_category_product'
    ])->name('all-category-product');

    // ===================================================================
    // Show Product
    Route::get('/all-product', [
        ProductController::class, 'all_product'
    ])->name('all-product');

    Route::get('/search-product', [
        ProductController::class, 'search_product'
    ])->name('search-product');

    //====================================================================
    //Show Discount
    Route::get('/all-discount', [
        DiscountController::class, 'all_discount'
    ])->name('all-discount');

    //Search Discount
    Route::get('/search-discount', [
        DiscountController::class, 'search_discount'
    ])->name('search-discount');

    //======================================================================
    //Show Comment
    Route::get('all-comment', [
        CommentController::class, 'all_comment'
    ])->name('all-comment');

    Route::get('search-comment', [
        CommentController::class, 'search_comment'
    ])->name('search-comment');

    Route::get('unactive-comment/{comment_id}', [
        CommentController::class, 'unactive_comment'
    ])->name('unactive-comment');

    Route::get('active-comment/{comment_id}', [
        CommentController::class, 'active_comment'
    ])->name('active-comment');

    Route::get('delete-comment/{comment_id}', [
        CommentController::class, 'delete_comment'
    ])->name('delete-comment');

    // ========================================================================
    //Show Category Post
    Route::get('all-category-post', [
        CategoryPostController::class, 'all_category_post'
    ])->name('all-category-post');

    // =========================================================================
    //Add Post
    Route::get('/add-post', [
        PostController::class, 'add_post'
    ])->name('add-post');

    //Save Post
    Route::post('/save-post', [
        PostController::class, 'save_post'
    ])->name('save-post');

    //All Post
    Route::get('/all-post', [
        PostController::class, 'all_post'
    ])->name('all-post');

    //Unactive Post
    Route::get('unactive-post/{posts_id}', [
        PostController::class, 'unactive_post'
    ])->name('unactive-post');

    //Active Post
    Route::get('active-post/{posts_id}', [
        PostController::class, 'active_post'
    ])->name('active-post');

    //Edit Post
    Route::get('/edit-post/{posts_id}', [
        PostController::class, 'edit_post'
    ])->name('edit-post');

    //Update Post
    Route::post('/update-post/{posts_id}', [
        PostController::class, 'update_post'
    ])->name('update-post');

    //Search Post
    Route::get('/search-post', [
        PostController::class, 'search_post'
    ])->name('search-post');
});
