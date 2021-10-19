<?php

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


Route::prefix('dashboard')->group(function () {
    Route::get('/', 'DashboardController@index')->name(('dashboard.index'));
    Route::resources([
        'category' => 'CategoryController',
        'voucher' => 'VoucherController',
        'order' => 'OrderController',
        'product' => 'ProductController',
        'user' => 'UserController'
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
