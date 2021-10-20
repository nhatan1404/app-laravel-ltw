<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');


Route::get('/category', 'CategoryController@index');


Route::group(['prefix' => '/dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name(('dashboard.index'));
    Route::get('/file-manager', 'DashboardController@fileManager')->name('file-manager');
    Route::resources([
        'category' => 'CategoryController',
        'voucher' => 'VoucherController',
        'order' => 'OrderController',
        'product' => 'ProductController',
        'user' => 'UserController'
    ]);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
