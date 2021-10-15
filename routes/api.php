<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiLoginController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [ApiLoginController::class, 'login']);

Route::group(['middleware' =>'auth:api'], function () {

    Route::get('room', [ApiController::class, 'api_room']);

    Route::get('quality', [ApiController::class, 'api_quality']);

    Route::get('product', [ApiController::class, 'api_product']);

    Route::get('product2', [ApiController::class, 'api_product2']);

    Route::get('term_payment', [ApiController::class, 'api_term_payment']);

    Route::post('/logout', [ApiLoginController::class, 'logout']);
});
