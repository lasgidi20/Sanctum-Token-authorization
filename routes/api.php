<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\CoinsController;
use App\Http\Controllers\API\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
});

Route::controller(CoinsController::class)->group(function(){
    Route::get('trending-coins', 'getTrendingCoins');
    Route::get('all-coins', 'getAllCoinsData');
    Route::get('/coin/{id}', 'getCoinByID');
    Route::get('/history/{days}', 'getHistoricalData');
});


        
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
});