<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommonController\AjaxController;
use App\Http\Controllers\CommonController\CommonTaskController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Expert\ExpertFeedbackController;
use App\Http\Controllers\Expert\ExpertProfileController;   
use App\Http\Controllers\Customer\AppointmentController; 
use App\Http\Controllers\Expert\ExpertAppoinmentController; 
use App\Http\Controllers\Expert\AvailabiltyController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\FeedbackController;
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\Admin\AdminAppoinmentController;
use App\Http\Controllers\Admin\AdminOrderController; 
use App\Http\Controllers\Admin\AdminExpertController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\Admin\ProductController; 
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\SettingController; 
use App\Http\Controllers\PagesController;

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

//clear cache route
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    echo '<script>alert("cache clear Success")</script>';
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    echo '<script>alert("config cache Success")</script>';
});
Route::get('/view', function () {
    Artisan::call('view:clear');
    echo '<script>alert("view clear Success")</script>';
});
Route::get('/route', function () {
    Artisan::call('route:cache');
    echo '<script>alert("route clear Success")</script>';
});
Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    echo '<script>alert("config clear Success")</script>';
});
Route::get('/storage', function () {
    Artisan::call('storage:link');
    echo '<script>alert("linked")</script>';
});
 


    // HOME ROUTES
    Route::get('', [HomeController::class, 'index_page']);
    Route::get('user_login', [HomeController::class, 'login_index'])->name('login');
    Route::post('user_login', [HomeController::class, 'login_account'])->name('login.account');
    Route::get('user_logout', [HomeController::class, 'login_logout'])->name('logout.account');
    Route::get('forgot_password', [HomeController::class, 'forgot_password'])->name('forgot_password');
    Route::post('forgot_password', [HomeController::class, 'forgot_password'])->name('forgot_password.submit'); 
    Route::get('reset_password', [HomeController::class, 'reset_password'])->name('reset_password');
    Route::post('reset_password', [HomeController::class, 'reset_password'])->name('reset_password.submit');

    // EXPERT PERSONAL DETAILS ROUTES
    Route::get('expert_personal_details', [ExpertController::class, 'expert_personal'])->name('expert.first.step');
    Route::post('expert_personal_post', [ExpertController::class, 'expert_personal_post'])->name('expert.first.step.post');

    // EXPERT PROFESSIONAL DETAILS ROUTES
    Route::get('expert_professional_details', [ExpertController::class, 'expert_professional'])->name('expert.second.step');
    Route::post('expert_professional_post', [ExpertController::class, 'expert_professional_post'])->name('expert.second.step.post');

    // EXPERT DOCUMENTS DETAILS ROUTES
    Route::get('expert_documents_details', [ExpertController::class, 'expert_documents'])->name('expert.third.step');
    Route::post('expert_documents_post', [ExpertController::class, 'expert_documents_post'])->name('expert.third.step.post');

    // EXPERT PLAN DETAILS ROUTES
    Route::get('expert_plan_details', [ExpertController::class, 'expert_plan'])->name('expert.fourth.step');
    Route::post('expert_plan_post', [ExpertController::class, 'expert_plan_post'])->name('expert.fourth.step.post');

    // CUSTOMER ROUTES
    Route::resource('customer', CustomerController::class)->only([
        'create', 'store'
    ]);

    Route::group(['prefix' => 'admin','middleware' => ['admin']], function() {  
        Route::get('login', [HomeController::class, 'login_index'])->name('admin.login');
        Route::get('forgot-password', [AdminController::class, 'forgot_password'])->name('admin.forgot_password');
        Route::post('forgot-password', [AdminController::class, 'forgot_password'])->name('admin.forgot_password.submit');  
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout.account');
    });

Route::group(['middleware' => ['administrator']], function(){
    Route::group(['prefix' => 'expert','middleware' => ['expert']], function() {
        Route::resource('profile', ExpertProfileController::class)->only([
            'update', 'edit'
        ]); 

        Route::get('change-status-appoinment/{id}/{status}', [ExpertAppoinmentController::class, 'changeStatusAppoinment'])->name('expappointment.changeStatusAppoinment');
        Route::post('expappointment-feedback', [ExpertAppoinmentController::class, 'feedback'])->name('expappointment.feedback');
        Route::post('give-note', [ExpertAppoinmentController::class, 'add_note'])->name('expappointmentNote');
        Route::resource('expappointment', ExpertAppoinmentController::class)->only([
            'update', 'edit', 'index'
        ]); 
       
        // FEEDBACKS ROUTE
        Route::get('feedbacks', [ExpertFeedbackController::class, 'feedback_list'])->name('expert.feedback');
        
         //change password
        Route::get('change-password',[ExpertProfileController::class, 'change_password'])->name('expert.change-password');

        Route::resource('availabilty', AvailabiltyController::class)->only([
            'index','create', 'store','update', 'edit'
        ]); 
    });

    Route::group(['prefix' => 'admin','middleware' => ['admin']], function() { 
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');   

        //change password
        Route::get('change-password', [AdminController::class, 'change_password'])->name('admin.change_password');
        Route::post('change-password', [AdminController::class, 'change_password'])->name('admin.change_password.submit'); 

        //contactus
        Route::get('contact-enquiery', [AdminController::class, 'contact_enquiery'])->name('admin.contact_enquiery');

        //appoinment
        Route::resource('adminappoinment', AdminAppoinmentController::class)->only(['index','show']);  
        
        //user
        Route::resource('admincustomer',AdminCustomerController::class);
        Route::resource('adminexpert', AdminExpertController::class); 

        //workshop
        Route::resource('workshop', WorkshopController::class);
        Route::get('workshop-delete/{id}', [WorkshopController::class, 'destroy'])->name('workshop.delete');

        //product
        Route::resource('product', ProductController::class);
        Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('product-change-status/{id}/{status}', [ProductController::class, 'changeStatus'])->name('product.changeStatus');
        Route::get('destroy-image/{id}/{product_id}', [ProductController::class, 'destroy_pImage'])->name('productImage.delete');
        
         //category
         Route::resource('category', CategoryController::class);
         Route::get('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
         Route::get('category-change-status/{id}/{status}', [CategoryController::class, 'changeStatus'])->name('category.changeStatus'); 
        
         //order routes
        Route::resource('adminOrder', AdminOrderController::class);
        Route::get('change-order-status', [AdminOrderController::class, 'changeOrderStatus'])->name('change-order-status');
        
        //settings
        Route::resource('settings', SettingController::class)->only(['update', 'edit']); 
    }); 

    Route::group(['middleware' => ['customer']], function() {
        Route::resource('profile', ProfileController::class)->only([
            'update', 'edit'
        ]); 

        //appointment 
        Route::resource('appointment', AppointmentController::class)->only([
            'create', 'store','index'
        ]); 
        Route::get('confirm-payment', [AppointmentController::class, 'payment_comfirm'])->name('appointment.confirm');
        Route::get('cancel-appoinment/{id}/{status}', [AppointmentController::class, 'cancelAppoinment'])->name('appointment.cancelAppoinment');
        Route::post('confirm-payment', [AppointmentController::class, 'payment'])->name('appointment.payment');
         
         //change password
        Route::get('change-password',[ProfileController::class, 'change_password'])->name('customer.change-password');


        //appointment 
        Route::resource('bookings', BookingController::class)->only([
            'create', 'store','index'
        ]); 
 
        // FEEDBACKS ROUTE
        Route::get('feedbacks', [FeedbackController::class, 'feedback_list'])->name('customer.feedback');
        Route::post('feedback-submit', [FeedbackController::class, 'feedback_submit'])->name('feedback_submit');

        // wishlist ROUTE
        Route::get('wishlist', [ProfileController::class, 'myWishlist'])->name('customer.myWishlist');

         // ORDERS ROUTE
         Route::get('orders', [OrderController::class, 'order_list'])->name('customer.order');
         Route::get('order_detail/{id}', [OrderController::class, 'order_detail'])->name('customer.order_detail');
        Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('confirm-order-payment', [OrderController::class, 'order_comfirm'])->name('order.confirm');
        Route::post('confirm-order-payment', [OrderController::class, 'payment'])->name('order.payment'); 
        Route::post('placeOrder', [OrderController::class, 'placeOrder'])->name('placeOrder');
        Route::post('addtocart', [OrderController::class, 'addtocart'])->name('addtocart');
        Route::get('viewcart', [OrderController::class, 'viewcart'])->name('viewcart'); 
        Route::post('updateCartQty', [OrderController::class, 'updateCartQty'])->name('updateCartQty');
        Route::get('deletecartItem/{id}/{delType}', [OrderController::class, 'deletecartItem'])->name('cartItem.delete');
        
        Route::post('addtofavourate', [OrderController::class, 'addtofavourate'])->name('addtofavourate');
    });                    
});

//other pages
Route::get('pricing', [PagesController::class, 'pricing_plan'])->name('page.pricing');
Route::get('about_us', [PagesController::class, 'about_us'])->name('page.about_us');
Route::get('services', [PagesController::class, 'services'])->name('page.services');
Route::get('shop', [PagesController::class, 'shop'])->name('page.shop');
Route::get('shop-detail/{id}', [PagesController::class, 'shopDetail'])->name('page.shopDetail');
Route::get('tools', [PagesController::class, 'tools'])->name('page.tools');
Route::get('blog', [PagesController::class, 'blog'])->name('page.blog');
Route::get('blog-detail', [PagesController::class, 'blogDetail'])->name('page.blogDetail');
Route::get('collaboration', [PagesController::class, 'collaboration'])->name('page.collaboration');
Route::get('contact', [PagesController::class, 'contact'])->name('page.contact');
Route::post('contact', [PagesController::class, 'contact'])->name('contact-submit');
Route::post('change-password', [HomeController::class, 'change_password'])->name('change-password-submit');



Route::namespace('CommonController')->group(function () {
	// STATE LIST ACCORDING COUNTRY ID
    Route::post('get_state_list', [AjaxController::class, 'get_state'])->name('state.list.ajax');
    Route::post('get_city_list', [AjaxController::class, 'get_city'])->name('city.list.ajax');
    Route::post('get_expert_list', [AjaxController::class, 'get_expert'])->name('expert.list.ajax');
    Route::post('get_timeslot_list', [AjaxController::class, 'get_timeslot'])->name('timeslot.list.ajax');
    Route::post('get_workshop_detail', [AjaxController::class, 'get_workshop_detail'])->name('workshop.detail.ajax');
    Route::get('account/verify', [CommonTaskController::class, 'verify_account'])->name('verify_account');
    
 
});