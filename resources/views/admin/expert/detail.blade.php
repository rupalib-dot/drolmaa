@extends('admin.layouts.app')

@section('content')

<style>
.contacts-block  li{
    margin-bottom:20px;
}
</style>

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Expert Details</h4>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-content widget-content-area">
                        <h3 class="">{{ucwords($expert->full_name)}}</h3>
                        <img style="width: 150px;" src="<?php if(!empty($expert->user_image)){?>{{asset('user_images/'.$expert->user_image)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>">
                    </div>
                    <div class="widget-content widget-content-area">
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
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Documents</h3>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="row">
                            <div class="col-lg-6">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead> 
                                    <tr>  
                                        <th>License</th>
                                        <th>Pan Card</th>
                                        <th>Aadhaar Cardr</th>
                                        <th>Professional Certificate</th> 
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr> 
                                        <td> <?php if(!empty($expert->licance_pic)){?><img style="width: 150px;" src="{{asset('expert_documents/'.$expert->licance_pic)}}"> </td> <?php }else{?>No document uploaded<?php }?>
                                        <td><?php if(!empty($expert->pan_card_pic)){?><img style="width: 150px;" src="{{asset('expert_documents/'.$expert->pan_card_pic)}}"> </td><?php }else{?>No document uploaded<?php }?>
                                        <td><?php if(!empty($expert->aadhar_card_pic)){?><img style="width: 150px;" src="{{asset('expert_documents/'.$expert->aadhar_card_pic)}}"> </td><?php }else{?>No document uploaded<?php }?>
                                        <td><?php if(!empty($expert->professional_certificate_pic)){?><img style="width: 150px;" src="{{asset('expert_documents/'.$expert->professional_certificate_pic)}}"> </td> <?php }else{?>No document uploaded<?php }?>
                                    </tr>  
                                </tbody>
                            </table>
                            </div>  
                        </div>             
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection  
