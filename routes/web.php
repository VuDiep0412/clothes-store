<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'ShopController@index')->name('shop.index');

//liên hệ
Route::get('/lien-he', 'ShopController@contact')->name('lienhe');
Route::post('/lien-he', 'ShopController@postContact')->name('shop.postContact');

//tin tức
Route::get('/tin-tuc', 'ShopController@article')->name('shop.article');
Route::get('/chi-tiet-tin-tuc/{slug}', 'ShopController@articleDetail')->name('shop.articleDetail');

//sản phẩm
Route::get('/san-pham','ShopController@product')->name('shop.product');
Route::get('/san-pham/{slug}','ShopController@productDetail')->name('shop.productDetail');
Route::get('/san-pham/danh-muc/{slug}','ShopController@cateProduct')->name('cateProduct');
// Route::get('/san-pham/gia','ShopController@priceProduct')->name('priceProduct');
Route::get('/chi-tiet-hoa-don','ShopController@cart')->name('shop.cart');

//tìm kiếm sp
Route::get('/tim-kiem','ShopController@search')->name('searchProduct');

//giỏ hàng
Route::get('/gio-hang','CartController@index')->name('cart');
Route::post('/gio-hang/them-san-pham','CartController@addToCart')->name('addToCart');
// Route::post('gio-hang/add','CartController@addToCart')->name('addToCart');
Route::get('/gio-hang/xoa-san-pham/{id}','CartController@removeToCart')->name('removeToCart');
//cập nhật số lượng trong giỏ

Route::get('/gio-hang/cap-nhat-so-luong-sp', 'CartController@update')->name('cartupdate');
// Hủy giỏ hàng

Route::resource('/wishlist', 'WishlistController');
// Route::post('yeu-thich/{$id}', 'WishlistController@store')->name('wishlist');


//đặt hàng
Route::get('/dat-hang', 'CartController@order')->name('order');
Route::post('/dat-hang', 'CartController@postOrder')->name('donhang');
Route::get('/dat-hang/hoan-tat-dat-hang', 'CartController@completeOrder')->name('complete');

//User login/register
Route::get('/dang-nhap', 'UserController@login')->name('dangnhap');
Route::post('/dang-nhap/checkLogin', 'UserController@postLogin')->name('checkLogin');
Route::get('/dang-xuat','UserController@logout')->name('dangxuat');
Route::get('/dang-ky','UserController@register')->name('dangky');
Route::post('/dang-ky/form','UserController@store')->name('register');
Route::get('/thong-tin','UserController@edit')->name('thongtin');
Route::put('/cap-nhat-thong-tin','UserController@update')->name('capnhat');

//Admin login
Route::get('/admin/login', 'AdminController@login')->name('admin.login');
Route::post('/admin/login', 'AdminController@postLogin')->name('admin.postLogin');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'checkLogin'], function (){
    Route::get('/','AdminController@index')->name('dashboard');

    Route::resource('role', 'RoleController');
    Route::resource('manager', 'ManagerController');
    Route::resource('banner', 'BannerController');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');
    Route::resource('product', 'ProductController');
    Route::resource('product_detail', 'ProductDetailController');
    Route::get('/product_image/create/{id}', 'ProductImageController@create')->name('product_image.create');
    Route::resource('product_image','ProductImageController')->except(['create']);
    Route::resource('coupon', 'CouponController');
    Route::resource('setting', 'SettingController');
    Route::resource('color', 'ColorController');
    Route::resource('size','SizeController');
    Route::resource('productSize','ProductSizeController');
    Route::resource('productColor','ProductColorController');
    Route::resource('contact','ContactController');
    Route::resource('user','UserController');
    Route::resource('order','OrderController');
});
//Route::resource('user', 'UserController');

