<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;

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





//Danh mục sản phẩm - Trang Chủ "Hung"============
Route::get('/danh-muc-san-pham/{category_id}', [
    CategoryProductController::class, 'show_category_home'
])->name('home'); 

Route::get('/chi-tiet-san-pham/{product_id}', [
    ProductController::class, 'detail_product'
])->name('home'); 

//Đánh giá sao
Route::post('/insert-rating', [
    ProductController::class,'Rating'
])->name('/insert-rating');

Route::get('/load-comment', [
    ProductController::class,'load_comment'
])->name('/load_comment');

Route::get('/send-comment', [
    ProductController::class,'send_comment'
])->name('/send_omment');
//Danh mục sản phẩm - Trang Chủ "Hung"============




// BACK-END
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

// END :  XỬ LÝ CATEGORY-PRODUCT (DASHBOARD)

//=====================================================================================

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

// End

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


