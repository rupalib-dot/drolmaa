@extends('admin.layouts.app')

@section('content')
<style> 
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
                            <h4>Workshop Details</h4>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>  
                                    <tr> 
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Date Of Birth</th> 
                                        <th>Status</th>
                                        <th>Payment Id</th> 
                                        <th>Amount</th>
                                        <th>Gender</th>  
                                    </tr>
                                </thead>
                                <tbody>  
                                @if(count($users_list)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($users_list as $aGetData) 
                                            <tr> 
                                                <td>{{$aGetData->booking_no}}</td> 
                                                <td>{{$aGetData->Users->full_name}} </td>
                                                <td>{{$aGetData->Users->email_address}}</td>
                                                <td>{{$aGetData->Users->mobile_number}}</td> 
                                                <td>{{date('Y-m-d',strtotime($aGetData->Users->user_dob))}}</td> 
                                                <td>{{ucwords(strtolower(array_search($aGetData->status,config('constant.STATUS'))))}}</td>
                                                <td>{{$aGetData->payment_id}}</td> 
                                                <td><i class="fas fa-rupee-sign"></i> {{CommonFunction::GetSingleField('workshop','price','workshop_id ',$aGetData->module_id)}}</td> 
                                                <td>{{array_search($aGetData->Users->user_gender,config('constant.GENDER'))}}</td>
                                            </tr> 
                                        @php $i++; @endphp
                                        @endforeach 
                                    @else
                                        <tr> 
                                            <td colspan="9">No Record Found</td>
                                        </tr> 
                                    @endif  
                                </tbody>
                            </table>
                        </div> 
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$users_list->appends($request->all())->render('vendor.pagination.custom')}}
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
