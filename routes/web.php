<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\sliderController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CommentController;



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
// Route::get('/', [
//     HomeController::class, 'index'
// ])->name('home');

// Route::get('/trang-chu', [
//     HomeController::class, 'index'
// ])->name('home');


// BACK-END..
Route::get('/admin_login', [
    AdminController::class, 'index'
])->name('admin_login');

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


// XỬ LÝ CATEGORY-PRODUCT (DASHBOARD)

Route::get('/add-category-product', [
    CategoryProductController::class, 'add_category_product'
])->name('add-category-product');

Route::get('/all-category-product', [
    CategoryProductController::class, 'all_category_product'
])->name('all-category-product');

// Xử lý Hiden/Show của trang all_category_product
Route::get('/unactive-category-product/{category_product_id}', [
    CategoryProductController::class, 'unactive_category_product'
])->name('unactive-category-product');

Route::get('/active-category-product/{category_product_id}', [
    CategoryProductController::class, 'active_category_product'
])->name('active-category-product');

// End

// Xử lý trang UPDATE CATEGORY
Route::get('/edit-category-product/{category_product_id}', [
    CategoryProductController::class, 'edit_category_product'
])->name('edit-category-product');

Route::post('/update-category-product/{category_product_id}', [
    CategoryProductController::class, 'update_category_product'
])->name('update-category-product');

Route::get('/delete-category-product/{category_product_id}', [
    CategoryProductController::class, 'delete_category_product'
])->name('delete-category-product');


Route::post('/save-category-product', [
    CategoryProductController::class, 'save_category_product'
])->name('save-category-product');

Route::get('/search-category-product', [
    CategoryProductController::class, 'search_category_product'
])->name('search-category-product');

// END
// END :  XỬ LÝ CATEGORY-PRODUCT (DASHBOARD)

// ============================================================================================================

// XỬ LÝ PRODUCT (DASHBOARD)

Route::get('/add-product', [
    ProductController::class, 'add_product'
])->name('add-product');

Route::get('/all-product', [
    ProductController::class, 'all_product'
])->name('all-product');

// Xử lý Hiden/Show của trang product
Route::get('/unactive-product/{product_id}', [
    ProductController::class, 'unactive_product'
])->name('unactive-product');

Route::get('/active-product/{product_id}', [
    ProductController::class, 'active_product'
])->name('active-product');


// Xử lý trang UPDATE Product
Route::get('/edit-product/{product_id}', [
    ProductController::class, 'edit_product'
])->name('edit-product');

Route::post('/update-product/{product_id}', [
    ProductController::class, 'update_product'
])->name('update-product');

Route::get('/delete-product/{product_id}', [
    ProductController::class, 'delete_product'
])->name('delete-product');


Route::post('/save-product', [
    ProductController::class, 'save_product'
])->name('save-product');

Route::get('/search-product', [
    ProductController::class, 'search_product'
])->name('search-product');

//============================================================================================================

// MANAGE DISCOUNT

Route::get('/add-discount', [
    DiscountController::class, 'add_discount'
])->name('add-discount');

Route::get('/all-discount', [
    DiscountController::class, 'all_discount'
])->name('all-discount');

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

Route::get('/search-discount', [
    DiscountController::class, 'search_discount'
])->name('search-discount');


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

// Route::post('/save-product', [
//     MemberController::class, 'save_product'
// ])->name('save-product');

//============================================================================================================


// Xử lý Banner

Route::get('manage-slider', [
    sliderController::class, 'manage_slider'
])->name('manage-slider');

Route::get('add-slider', [
    sliderController::class, 'add_slider'
])->name('add-slider');

Route::post('insert-slider', [
    sliderController::class, 'insert_slider'
])->name('insert-slider');

// Xử lý Hiden/Show của trang slider
Route::get('/unactive-slide/{id}', [
    sliderController::class, 'unactive_slide'
])->name('unactive-slide');

Route::get('/active-slide/{id}', [
    sliderController::class, 'active_slide'
])->name('active-slide');

Route::get('/delete-slide/{id}', [
    sliderController::class, 'delete_slide'
])->name('delete-slide');

Route::get('/search-slider', [
    sliderController::class, 'search_slider'
])->name('search-slider');

//============================================================================================================
//Quản lý Order


// MANAGE ORDER
Route::get('/view-order', [
    OrderController::class, 'view_order'
])->name('view-order');

// Route::get('/delete-order/{id}', [
//     OrderController::class, 'delete_order'
// ])->name('delete-order');


//============================================================================================================

// MANAGE COMMENT
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
