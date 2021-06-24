<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\CustomerController;
use App\Http\Controllers\ApiController\LocationController;
use App\Http\Controllers\ApiController\WrokshopController;
use App\Http\Controllers\ApiController\BookingController;
use App\Http\Controllers\ApiController\CommonController;

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

// LOCATIONS API
Route::get('country', [LocationController::class, 'country_list']);
Route::post('state', [LocationController::class, 'state_list']);
Route::post('city', [LocationController::class, 'city_list']);

// CUSTOMER REGISTER, UPDATE, PROFILE API
Route::resource('customer', CustomerController::class)->only([
    'store', 'show', 'update'
]);

// WORKSHOP API
Route::resource('workshop', WrokshopController::class)->only([
    'index'
]);

// BOOKING API
Route::resource('booking', BookingController::class)->only([
    'index', 'store'
]);

Route::post('login_account', [CommonController::class, 'login_account']);
Route::post('change_password', [CommonController::class, 'change_password']);
Route::post('resend_opt', [CommonController::class, 'resend_opt']);
Route::post('forgot_password', [CommonController::class, 'forgot_password']);
Route::post('reset_password', [CommonController::class, 'reset_password']);