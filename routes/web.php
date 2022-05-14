<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderControllerApi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartControllerApi;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin']);
Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'storeSignup']);

Route::group(['middleware' =>'auth'], function(){
Route::get('/', function () {
    return view('index');
});

Route::prefix('master-data')->group(function(){

    //Product
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::get('/product/{product}/edit', [ProductController::class, 'edit']);
    Route::patch('/product/{product}', [ProductController::class, 'update']);
    Route::delete('/product/{product}', [ProductController::class, 'destroy']);
    
    //table
    Route::get('/table', [TableController::class, 'index']);
    Route::post('/table', [TableController::class, 'store']);
    Route::get('/table/create', [TableController::class, 'create']);
    Route::get('/table/{table}/edit', [TableController::class, 'edit']);
    Route::patch('/table/{table}', [TableController::class, 'update']);
    Route::delete('/table/{table}', [TableController::class, 'destroy']);
    
    //order
    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/order/create', [OrderController::class, 'create']);
    Route::get('/order/{order}/edit', [OrderController::class, 'edit']);
    Route::patch('/order/{order}', [OrderController::class, 'update']);
    Route::delete('/order/{order}', [OrderController::class, 'destroy']);

    //CART
    Route::get('/cart', [CartControllerApi::class, 'index']);
    
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/order/detailorder/{order}', [OrderControllerApi::class, 'show']);
});


});
