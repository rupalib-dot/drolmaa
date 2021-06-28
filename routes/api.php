<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\CustomerController;
use App\Http\Controllers\ApiController\LocationController;
use App\Http\Controllers\ApiController\WrokshopController;
use App\Http\Controllers\ApiController\BookingController;
use App\Http\Controllers\ApiController\AppointmentController;
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
Route::fallback(function(){
    return response()->json([
        'ResponseCode'  => 404,
        'status'        => False,
        'message'       => 'URL not found as you looking']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// LOCATIONS API
Route::get('country', [LocationController::class, 'country_list']);
Route::get('state/{country_id}', [LocationController::class, 'state_list']);
Route::get('city/{state_id}', [LocationController::class, 'city_list']);

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

// FEEDBACK API
Route::resource('feedback', CommonController::class)->only(['index','store']);

// APPOINTMENT API
Route::resource('appointment', AppointmentController::class)->only(['index','store']);
Route::get('appointment_cancel/{appointment_id}', [AppointmentController::class, 'appointment_cancel']);
Route::get('appointment_plan_list', [AppointmentController::class, 'appointment_plan_list']);
Route::get('expert_list/{designation_id}', [AppointmentController::class, 'expert_list']);
Route::get('availability_slot/{user_id}/{date}', [AppointmentController::class, 'availability_slot_list']);

Route::post('login_account', [CommonController::class, 'login_account']);
Route::post('change_password', [CommonController::class, 'change_password']);
Route::post('resend_opt', [CommonController::class, 'resend_opt']);
Route::post('forgot_password', [CommonController::class, 'forgot_password']);
Route::post('reset_password', [CommonController::class, 'reset_password']);
Route::get('designation', [CommonController::class, 'designation_list']);