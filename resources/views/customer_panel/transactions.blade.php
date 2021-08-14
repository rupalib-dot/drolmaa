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
                                <h3 class="order-content text-center">Welcome to y DrolMaa Constellation Club || </h3>
                     <div class="mt-3">
                        <div class="profile-form">
                        <h3 class="order-content">{{$title}}</h3>
                           
                        <div class="row layout-top-spacing" style="margin-top:40px"> 
                                    <div class="widget-heading col-lg-12">
                                        <h5 class="">Transactions</h5>
                                    </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="{{route('custransaction.index',['type'=>'order'])}}">
                                        <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                                <div class="widget-heading">
                                                    <p class="w-value"><i class="fas fa-id-card"></i></p>
                                                    <h5 class=""> 
                                                    Orders
                                                    </h5>
                                                </div> 
                                        </div>
                                    </a>
                                </div>
                               
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <a href="{{route('custransaction.index',['type'=>'appointment'])}}">
                                    <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                             <div class="widget-heading">
                                                <p class="w-value"><i class="far fa-calendar-check"></i></p>
                                                <h5 class="">Appoinments</h5>
                                            </div> 
                                       </div>
                                </a>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="{{route('custransaction.index',['type'=>'booking'])}}">
                                         <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                            <div class="widget-heading">
                                                <p class="w-value"><i class="fas fa-vote-yea"></i></p>
                                                <h5 class="">Bookings</h5>
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
    </div>
</section>
@include('include.footer')
@include('include.script') 