<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\CustomerController;
use App\Http\Controllers\ApiController\LocationController;
use App\Http\Controllers\ApiController\workshopController; 
use App\Http\Controllers\ApiController\AppoinmentController;
use App\Http\Controllers\ApiController\BookingController;
use App\Http\Controllers\ApiController\OrderController;
use App\Http\Controllers\ApiController\ExpertController;
use App\Http\Controllers\ApiController\CommonController;
use App\Http\Controllers\ApiController\AvailabilityController;
use App\Http\Controllers\ApiController\ProductController;
use App\Http\Controllers\ApiController\HomeController;

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

//common apis
Route::get('designation', [CommonController::class, 'designation_list']); 
Route::get('common_function', [CommonController::class, 'commonFunction']);
Route::post('resend_otp', [CommonController::class, 'resend_otp']);
Route::post('payment', [HomeController::class, 'Payment']);


//auth related apis
Route::post('login_account', [CommonController::class, 'login_account']);
Route::post('change_password', [CommonController::class, 'change_password']);
Route::post('resend_opt', [CommonController::class, 'resend_opt']);
Route::post('forgot_password', [CommonController::class, 'forgot_password']);
Route::post('reset_password', [CommonController::class, 'reset_password']);
Route::post('update_profile_pic/{user_id}', [CommonController::class, 'update_profile_pic']);

// CUSTOMER REGISTER, UPDATE, PROFILE API
Route::resource('customer', CustomerController::class);

// Expert API
Route::resource('expert', ExpertController::class);
Route::post('storePayment', [ExpertController::class, 'store_payment']);
Route::post('checkPhoneEmail', [ExpertController::class, 'checkPhoneEmail']);
Route::post('expert_list', [ExpertController::class, 'expertList']);
Route::get('expert_detail/{user_id}', [ExpertController::class, 'expertDetail']);
Route::post('renew_subscription', [ExpertController::class, 'store_payment']);

//home api
Route::post('dashboard/{user_id}', [HomeController::class, 'dashboard']);

//product list api
Route::post('products', [ProductController::class, 'products']);
Route::post('product_detail/{product_id}', [ProductController::class, 'product_detail']); 
Route::post('add_favourate', [ProductController::class, 'add_product_favourate']);
 
//wishlist api
Route::get('my_wishlist/{user_id}', [ProductController::class, 'wishlist']);
Route::post('deleteWishlist', [ProductController::class, 'deleteWishlist']);

//service list api
Route::post('services', [HomeController::class, 'services']);

// FEEDBACK API
Route::post('feedback_store',  [HomeController::class, 'storeFeedback']);
Route::get('my_feedback/{user_id}', [HomeController::class, 'feedbackList']);
 

// WORKSHOP API 
Route::post('workshop_index/{userid}', [workshopController::class, 'index']);
Route::post('store_workshop', [workshopController::class, 'store']);
Route::post('edit_workshop/{userid}', [workshopController::class, 'update']); 
Route::post('delete_workshop/{userid}', [workshopController::class, 'destroy']); 
Route::post('live_workshops', [workshopController::class, 'liveWorkshops']);

//booking apis
Route::get('my_bookings/{user_id}', [BookingController::class, 'index']);
Route::post('create_booking', [BookingController::class, 'store']);  

// APPOINTMENT API 
Route::post('appointment/{user_id}', [AppoinmentController::class, 'index']);
Route::get('change_appointment_status/{appointment_id}/{status}', [AppoinmentController::class, 'changeStatusAppoinment']); 
Route::post('store', [AppoinmentController::class, 'store']);
Route::post('get_timeslot', [AppoinmentController::class, 'getTimeslot']);
 
// ORDER API 
Route::post('order_listing/{user_id}', [OrderController::class, 'index']);   
Route::post('create_order', [OrderController::class, 'store']);  
Route::post('order_change_status/{user_id}/{status}', [OrderController::class, 'changeOrderStatus']);  
Route::post('apply_coupon', [OrderController::class, 'ApplyCoupon']);  

//Availability APIs
Route::post('availability/{user_id}', [AvailabilityController::class, 'index']);
Route::post('create_availability/{user_id}', [AvailabilityController::class, 'store']);
Route::post('edit_availability/{userid}/{availability_id}', [AvailabilityController::class, 'update']);
Route::post('delete_availability/{userid}/{availability_id}', [AvailabilityController::class, 'destroy']);

//Transactions APIs
Route::post('transactions/{userid}', [HomeController::class, 'transactions']);



