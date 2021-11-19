<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Main page
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');

// Product
Route::get('/product', 'HomeController@productList')->name('product-list');
Route::get('/product/{slug}', 'HomeController@productDetail')->name('product-detail');

//Category
Route::get('/category/{slug}', 'HomeController@productByCategory')->name('product-by-category');

// Posts
Route::get('/posts', 'HomeController@postsList')->name('posts-list');
Route::get('/posts/{slug}', 'HomeController@postsDetail')->name('posts-detail');
Route::get('/posts-category/{slug}', 'HomeController@postsByCategory')->name('posts-by-category');

// Shoping
Route::get('/cart', 'CartController@getListCart')->name('cart')->middleware('auth');
Route::get('/cart/{id}', 'CartController@addToCart')->name('add-cart')->middleware('auth');
Route::put('/cart/{id}', 'CartController@updateCart')->name('update-cart')->middleware('auth');
Route::delete('/cart/{id}', 'CartController@removeCart')->name('remove-cart')->middleware('auth', 'throttle:30,1');
Route::get('/checkout', 'HomeController@checkout')->name('checkout')->middleware('auth');
Route::post('/order', 'HomeController@order')->name('order')->middleware('auth');

// Address
Route::get('/address/provinces', 'AddressController@getProvinces')->name('get-provinces')->middleware('auth');
Route::get('/address/districts/{id}', 'AddressController@getDistricts')->name('get-districts');
Route::get('/address/wards/{id}', 'AddressController@getWards')->name('get-wards');

// User
Route::get('/user/login', 'HomeController@login')->name('user-login');
Route::post('/user/login', 'Auth\LoginController@login');
Route::post('/user/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('user/register', 'HomeController@register')->name('user-register');
Route::post('user/register', 'Auth\RegisterController@register');
Route::get('/profile/{id}', 'HomeController@profile')->name('profile');

// Auth
Auth::routes();

// Dashboard
Route::group(['prefix' => '/dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name(('dashboard'));
    Route::get('/file-manager', 'DashboardController@fileManager')->name('file-manager');
    Route::resources([
        'category' => 'CategoryController',
        'voucher' => 'VoucherController',
        'order' => 'OrderController',
        'product' => 'ProductController',
        'user' => 'UserController',
        'posts' => 'PostsController',
        'posts-category' => 'PostsCategoryController',
    ]);
});

// Laravel File Manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
