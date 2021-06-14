@include('include.header')
@include('include.nav')
<style>
    .razorpay-payment-button
    {
        background-color : #ba4811;
        border-color : #c2490f;
        color : white;
        padding:6px;
    }
        
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.client_sidebar')
                        <div class="col-md-9">
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">{{$title}}</h3>    
                                <div class="row">    
                                    <div class="input-group mb-4"> 
                                        <select onchange="workshop_details(this.value)" class="form-control" id="exampleFormControlSelect1"
                                            placeholder="Workshop" name="module_id" aria-label="Workshop"
                                            aria-describedby="basic-addon2">
                                            <option value=""> Select Workshop For Booking Which You Want To Book</option>
                                            @foreach($workshop_list as $workshop)
                                                <option {{ old('module_id') == $workshop->workshop_id ? 'selected' : ''}} value="{{$workshop->workshop_id}}">{{ucfirst(strtolower($workshop->title))}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="workshop_detail" style="display:none"> 
                                    <div class="row" style="margin:20px">
                                        <div class="col-lg-6">
                                            <p id="title"> </p>
                                            <p id="designation"></p>
                                            <p id="expert"></p>
                                            <p id="price"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p id="date"></p>
                                            <p id="time"></p>
                                        </div> 
                                        <form action="" id="payment" method="POST">
                                            @csrf
                                            <input type="hidden" id="module_id" name="module_id">
                                            <input type="hidden" id="module_type" name="module_type">
                                            <script class="paymentWidget" data-prefill.name="{{Session::get('full_name')}}" data-prefill.email="rupalibhargava@gmail.com"></script>
                                        </form>
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
<script>
$(document).ready(function() {
    var module_id = $("select[name=module_id]").val();
    if(module_id != '')
    { 
        workshop_details(module_id);
    } 
});
</script> 