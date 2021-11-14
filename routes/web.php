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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/login', 'HomeController@contact')->name('login');
Route::get('/register', 'HomeController@contact')->name('register');
Route::get('/profile/{id}', 'HomeController@contact')->name('profile');
Route::get('/product', 'HomeController@productList')->name('product-list');
Route::get('/product/{slug}', 'HomeController@productDetail')->name('product-detail');
Route::get('/posts', 'HomeController@postsList')->name('posts-list');
Route::get('/posts/{slug}', 'HomeController@postsDetail')->name('posts-detail');
Route::get('/checkout', 'HomeController@postsDetail')->name('checkout');


Route::get('/category', 'CategoryController@index');


Route::group(['prefix' => '/dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name(('dashboard.index'));
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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
