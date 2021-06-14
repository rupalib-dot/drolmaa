@include('admin.layouts.header')    
<style>
    li{
     margin-bottom: 10px;
    }
</style>

 <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('admin.layouts.sidebar')   

         <div id="content" class="main-content"> 
             <div class="page-header" style = "margin-left: 25px">
                    <div class="page-title">
                        <h3>{{$title}}</h3>
                    </div>
                </div>
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;"> 
            <div class="widget-header">  
                @include('admin.layouts.validation_message')
                @include('admin.layouts.auth_message')      
            </div> 
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;">                     
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow"> 
                            <div class="row layout-spacing"> 
                                <!-- Content -->
                                <h4 style="margin-left: 15px;" class="">PERSONAL INFO</h4>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">  
                                    <div class="user-profile layout-spacing">  
                                        <div class="d-flex justify-content-between"> 
                                            <h3 class="">{{ucwords($expert->full_name)}}</h3>
                                            <img style="width: 150px;" src="<?php if(!empty($expert->user_image)){?>{{asset('user_images/'.$expert->user_image)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>">
                                        </div>  
                                        <div class="user-info-list"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <ul class="contacts-block list-unstyled" style="max-width: 100%;">
                                                        <li><b>Email:-</b> {{$expert->email_address}}</li>
                                                        <li><b>Mobile Number:-</b> {{$expert->mobile_number}}</li> 
                                                        <li><b>Office Phone Number:-</b> {{$expert->office_phone_number}}</li>  
                                                        <li><b>Designation:-</b> {{CommonFunction::GetSingleField('designation','designation_title','designation_id',$expert->designation_id)}}</li>
                                                        <li><b>Age:-</b> {{$expert->user_age}}</li>
                                                        <li><b>Gender:-</b> {{array_search($expert->user_gender,config('constant.GENDER'))}}</li> 
                                                    </ul>
                                                </div> 
                                                <div class="col-lg-6">
                                                    <ul class="contacts-block list-unstyled" style="max-width: 100%;"> 
                                                        <li><b>Experience:-</b> {{$expert->user_experience}}</li> 
                                                        <li><b>Country:-</b> {{CommonFunction::GetSingleField('country','country_name','country_id',$expert->country_id)}}</li>
                                                        <li><b>State:-</b> {{CommonFunction::GetSingleField('state','state_name','state_id',$expert->state_id)}}</li>
                                                        <li><b>City:-</b> {{CommonFunction::GetSingleField('city','city_name','city_id',$expert->city_id)}} </li>
                                                        <li><b>Address:-</b> {{$expert->address_details}} </li>
                                                    </ul>
                                                </div> 
                                            </div>               
                                        </div> 
                                    </div> 
                                </div>  
                            </div>  
                        </div>
                    </div> 
                </div> 
               
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow"> 
                            <div class="row layout-spacing"> 
                                <!-- Content -->
                                <h4 style="margin-left: 15px;" class="">Documents</h4>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">  
                                    <div class="user-profile layout-spacing">  
                                        <div class="user-info-list"> 
                                            <div class="row"> 
                                                <div class="col-lg-3">
                                                   <p><b>Licance</b></p> <img style="width: 150px;" src="<?php if(!empty($expert->licance_pic)){?>{{asset('expert_documents/'.$expert->licance_pic)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>"> 
                                                </div>
                                                <div class="col-lg-3">
                                                    <p><b>Pan card</b></p> <img style="width: 150px;" src="<?php if(!empty($expert->pan_card_pic)){?>{{asset('expert_documents/'.$expert->pan_card_pic)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>"> 
                                                </div>
                                                <div class="col-lg-3">
                                                    <p><b>Aadhar Card</b></p> <img style="width: 150px;" src="<?php if(!empty($expert->aadhar_card_pic)){?>{{asset('expert_documents/'.$expert->aadhar_card_pic)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>"> 
                                                </div>
                                                <div class="col-lg-3">
                                                    <p><b>Professional Certificate</b></p> <img style="width: 150px;" src="<?php if(!empty($expert->professional_certificate_pic)){?>{{asset('expert_documents/'.$expert->professional_certificate_pic)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>"> 
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
        

@include('admin.layouts.footer')   