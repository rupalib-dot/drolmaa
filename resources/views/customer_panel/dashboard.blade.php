@include('include.header')
@include('include.nav')
<style> 
.razorpay-payment-button{
    color: #fff;
    background-color: #d87611;
    border-color: #d87611;  
    font-weight: 400; 
    text-align: center;
    vertical-align: middle; 
    user-select: none; 
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem; 
}
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.client_sidebar')
                        <div class="col-md-10">
                            <div class="profile-form">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content text-center">Welcome to DrolMaa Constellation Club</h3>
                     <div class="mt-3">
                        <div class="profile-form">
                        <h3 class="order-content">{{$title}}</h3>
                           
                            <div class="row layout-top-spacing" style="margin-top:40px"> 
                                    <div class="widget-heading col-lg-12">
                                        <h5 class="">Menu</h5>
                                    </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="{{url('profile')}}/{{Session::get('user_id')}}/edit">
                                            <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                                <div class="widget-heading">
                                                    <p class="w-value"><i class="fas fa-id-card"></i></p>
                                                    <h5 class="">My Profile</h5>
                                                </div>
                                            </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <a href="{{route('customer.transactions')}}">
                                    <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                            <div class="widget-heading">
                                                <p class="w-value"><i class="fas fa-exchange-alt"></i></p>
                                                <h5 class="">Transactions</h5>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="{{route('appointment.index')}}">
                                        <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                            <div class="widget-heading">
                                                <p class="w-value"><i class="far fa-calendar-check"></i></p>
                                                <h5 class="">My Appointments</h5>
                                            </div> 
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="{{route('customer.order')}}">
                                        <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                            <div class="widget-heading">
                                                <p class="w-value"><i class="fas fa-vote-yea"></i></p>
                                                <h5 class="">My Orders</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                             </div>
                            <div class="row layout-top-spacing" style="margin-top:40px"> 
                                    <!-- <div class="widget-heading col-lg-12">
                                        <h5 class="">Current Month Records</h5>
                                    </div> -->
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <a href="{{route('bookings.index')}}">
                                                <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                                    <div class="widget-heading">
                                                        <p class="w-value"><i class="fas fa-bookmark"></i></p>
                                                        <h5 class="">My Bookings</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="{{route('customer.feedback')}}">
                                        <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                            
                                                <div class="widget-heading">
                                                    <p class="w-value"><i class="far fa-comment-dots"></i></p>
                                                    <h5 class="">My Feedbacks</h5>
                                                </div> 
                                          
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <a href="{{route('customer.myWishlist')}}">
                                            <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                                <div class="widget-heading">
                                                    <p class="w-value"><i class="far fa-heart"></i></p>
                                                    <h5 class="">My Wishlist</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('include.footer')
@include('include.script') 