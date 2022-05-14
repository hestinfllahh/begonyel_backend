<?php

use App\Http\Controllers\CartControllerApi;
use App\Http\Controllers\OrderControllerApi;
use App\Http\Controllers\ProductControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductControllerApi::class, 'index']);

Route::get('/cart', [CartControllerApi::class, 'index']);
Route::post('/cart/destroy', [CartControllerApi::class, 'destroy']);
Route::post('/cart', [CartControllerApi::class, 'store']);

Route::get('/products/{product}', [ProductControllerApi::class, 'show']);



Route::post('/order', [OrderControllerApi::class, 'store']);