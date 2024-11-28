<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VnPayController;
use App\Http\Controllers\WishListController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CheckUserLoign;
use App\Http\Middleware\UserNotLogin;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    // Route::get('/test', 'province');
    Route::get('/xem-nhanh-san-pham/{id}', 'quickview');
    Route::get('/chi-tiet-san-pham-p{id}', 'detail');
    Route::get('/danh-muc-san-pham-c{id}', 'subCategory');
    Route::get('/tim-kiem-san-pham', 'search');
    Route::get('/lien-he', 'contact')->name('home.contact');
    Route::post('/search-suggestions', 'searchSuggestions');

    Route::post('/load-data-categories-search', 'loadDataCategorieSearch');
    Route::post('/load-data-brands-search', 'loadDataBrandsSearch');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/gio-hang', 'index');
    Route::post('/gio-hang/getData', 'getCartsData');
    Route::post('/gio-hang/them-vao-gio', 'add');
    Route::post('/gio-hang/delete', 'delete');
    Route::post('/gio-hang/update', 'updateQuantity');
    Route::get('/dat-hang', 'checkout');

    /* Get Data Districts & Wards */
    Route::post('/cart/districts', 'districts');
    Route::post('/cart/wards', 'wards');

    Route::post('/cart/doCheckoutCustomer', 'doCheckoutCustomer');
    Route::post('/cart/doCheckoutUser', 'doCheckoutUser');

    Route::get('/dat-hang-thanh-cong/id-{orderId}', 'checkMark');
});

Route::controller(VnPayController::class)->group(function () {
    Route::post('/vnpay/payment', 'createPayment')->name('payment.create');
    Route::get('/vnpay/result', 'vnpayReturn')->name('payment.return');
});

Route::middleware(CheckAdminLogin::class)->controller(AttributeController::class)->group(function () {
    Route::get('/manage/attribute', 'index');
    Route::get('/manage/attribute/delete/{id}', 'delete');
    Route::match(['get', 'post'], '/manage/attribute/add', 'addAttribute');
    Route::match(['get', 'post'], '/manage/attribute/edit/{id}', 'editAttribute');
});


Route::middleware(CheckAdminLogin::class)->controller(CategoryController::class)->group(function () {
    Route::get('/manage/category', 'index')->name('category.index');
    Route::match(['get', 'post'], '/manage/category/add', 'add');
    Route::match(['get', 'post'], '/manage/category/edit/{id}', 'edit');
});

Route::middleware(CheckAdminLogin::class)->controller(BrandController::class)->group(function () {
    Route::get('/manage/brand', 'index')->name('brand.index');
    Route::match(['get', 'post'], '/manage/brand/add', 'add');
    Route::match(['get', 'post'], '/manage/brand/edit/{id}', 'edit');
});

Route::middleware(CheckAdminLogin::class)->controller(ProductController::class)->group(function () {
    Route::get('/manage/product', 'index')->name('product.index');
    Route::match(['get', 'post'], '/manage/product/add', 'add')->name('product.add');
    Route::get('/manage/product/edit/{id}', 'edit')->name('product.edit');
    Route::post('/manage/product/doEdit', 'doEdit');
});

Route::controller(AuthController::class)->group(function () {
    //Users
    Route::middleware(UserNotLogin::class)->get('/tai-khoan/dang-nhap', 'index')->name('auth.index');
    Route::middleware(UserNotLogin::class)->post('/auth/register', 'register');
    Route::middleware(UserNotLogin::class)->post('/auth/login', 'login');
    Route::middleware(UserNotLogin::class)->get('/auth/google', 'google');
    Route::middleware(UserNotLogin::class)->get('/auth/google-signin', 'googleSignIn');
    Route::middleware(UserNotLogin::class)->match(['get', 'post'], '/tai-khoan/quen-mat-khau', 'forgot');
    Route::middleware(UserNotLogin::class)->post('/auth/reset-password', 'resetPassword');

    Route::middleware(CheckUserLoign::class)->get('/tai-khoan/dang-xuat-nguoi-dung', 'logoutUser');

    //Admin
    Route::match(['get', 'post'], '/admin/login', 'loginAdmin');
    Route::middleware(CheckAdminLogin::class)->get('/admin/logout', 'logoutAdmin');
});

Route::middleware(CheckAdminLogin::class)->controller(ManageController::class)->group(function () {
    Route::get('/manage', 'index');
});

Route::controller(CouponController::class)->group(function () {
    Route::middleware(CheckAdminLogin::class)->get('/manage/coupon', 'index');
    Route::middleware(CheckAdminLogin::class)->match(['get', 'post'], '/manage/coupon/add', 'add');
    Route::middleware(CheckAdminLogin::class)->match(['get', 'post'], '/manage/coupon/edit/{id}', 'edit');

    Route::post('/coupon/check', 'checkCodeCoupon');
});

Route::controller(OrderController::class)->group(function () {
    Route::middleware(CheckAdminLogin::class)->get('/manage/order', 'index');
    Route::middleware(CheckAdminLogin::class)->get('/manage/order/total-revenue', 'totalRevenue');

    Route::middleware(CheckAdminLogin::class)->post('/manage/order/order-detail', 'getOrderDetail');
    Route::middleware(CheckAdminLogin::class)->post('/manage/order/update-status', 'updateStatus');

    Route::post('/manage/order/cancel-order', 'cancelOrder');
});


Route::middleware(CheckUserLoign::class)->controller(UserController::class)->group(function () {
    Route::get('/tai-khoan/thong-tin-tai-khoan', 'index');
    Route::get('/tai-khoan/san-pham-yeu-thich', 'wishList');
    Route::get('/tai-khoan/don-dat-hang', 'orderHistory');
    Route::get('/tai-khoan/chi-tiet-don-hang-id={order_id}', 'orderInformation');
});

Route::controller(WishListController::class)->group(function () {
    Route::post('/wishlist/add', 'add');
    Route::middleware(CheckUserLoign::class)->post('/wishlist/delete', 'delete');
});


Route::controller(ShippingController::class)->group(function () {
    Route::get('/shipping/calculate', 'getShippingCost');
});


Route::middleware(CheckAdminLogin::class)->controller(BannerController::class)->group(function () {
    Route::get('/manage/banner', 'index')->name('banner.add');
    Route::match(['get', 'post'], '/manage/banner/add', 'add');
});

Route::controller(PDFController::class)->group(function () {
    Route::middleware(CheckAdminLogin::class)->get('/orders/export/total-revenue', 'exportTotalRevenue')
        ->name('exprot.totalRevenue');
});
