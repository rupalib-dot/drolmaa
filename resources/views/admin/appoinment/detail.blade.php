@extends('admin.layouts.app')

@section('content')

<style>
.contacts-block  li{
    margin-bottom:20px;
} 
.checked{
   color: #ffc800;
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
                            <h4>Appoinment Details</h4>
                            </div>
                        </div>
                    </div> 
                </div>     

                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Appoinment Id:- {{$appoinment->appoinment_no}}</h3> 
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="contacts-block list-unstyled" style="max-width: 100%;">
                                    <li><b>Name :- </b>{{$appoinment['name']}}</li> 
                                    <li><b>Customer :-</b> {{CommonFunction::GetSingleField('users','full_name','user_id',$appoinment['user_id'])}}</li> 
                                    <li><b>Expert :-</b> {{CommonFunction::GetSingleField('users','full_name','user_id',$appoinment['expert'])}}</li>
                                    <li><b>Designation :-</b> {{CommonFunction::GetSingleField('designation','designation_title','designation_id',$appoinment['designation'])}}</li> 
                                    <li><b>Amount :- </b>{{$appoinment['amount']}}</li>  
                                    <li><b>Amount Refund :- </b>{{$appoinment['amount_refund']}}</li> 
                                    <li><b>Payment Mode:- </b>{{ucwords(strtolower(array_search($appoinment['payment_mode'],config('constant.PAYMENT_MODE'))))}}</li>
                                </ul>
                            </div> 
                            <div class="col-lg-6">
                                <ul class="contacts-block list-unstyled" style="max-width: 100%;">   
                                    <li><b>Plan :-</b> {{ucwords(strtolower(array_search($appoinment['plan'],config('constant.PLAN'))))}}</li> 
                                    <li><b>Note :-</b> {{$appoinment['note']}}</li> 
                                    <li><b>Date :-</b> {{date('d M,Y',strtotime($appoinment['date']))}}</li>
                                    <li><b>Time :-</b>{{date('h:i A',strtotime($appoinment['time'])) .' - '. date("h:i A",strtotime('+1 hours',strtotime($appoinment['time'])))}}</li>
                                    <li><b>Status :-</b> {{ucwords(strtolower(array_search($appoinment['status'],config('constant.STATUS'))))}}</li>
                                    <li><b>Payment Id :- </b>{{$appoinment['payment_id']}}</li> 
                                    <li><b>Refund Id :- </b>{{$appoinment['refund_id']}}</li> 
                                </ul>
                            </div> 
                        </div>             
                    </div>
                </div>  
                <div class="statbox widget box box-shadow mb-1"> 
                    <div class="widget-content widget-content-area">
                        <div class="row">
                        <h3>Feedback</h3>
                            <div class="col-sm-12">
                                @if(count($feedback_list)>0)
                                    @foreach($feedback_list as $feedback)
                                    <?php $image_name = CommonFunction::GetSingleField('users','user_image','user_id',$feedback->feedback_by); ?>
                                        <div class="feedback-profile">
                                            <div class="feedback-rating">
                                                <div class="feedback-box"
                                                    style="background-image:<?php if(!empty($image_name)){?>{{asset('user_images/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?> ">
                                                </div>
                                                <h2>{{CommonFunction::GetSingleField('users','full_name','user_id',$feedback->feedback_by)}}</h2>
                                                <p class="java-tech">Feedback On:- {{ucwords(strtolower(array_search($feedback->module_type,config('constant.FEEDBACK'))))}}</p>

                                            </div>
                                            <div class="star">
                                                <span class="review-star">{{$feedback->rating}}</span>
                                                @if($feedback->rating == 1)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($feedback->rating == 2)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($feedback->rating == 3)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($feedback->rating == 4)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @else 
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                @endif
                                            </div>
                                            <p class="quote-feedback">
                                                {{$feedback->message}}
                                            </p>
                                            <p style="padding-top: 15px;text-align: right;color: var(--black1);">
                                                {{$feedback->created_at}}
                                            </p>
                                        </div>
                                    @endforeach
                                    @else
                                    No record found
                                @endif 
                            </div>
                        </div>            
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection  
