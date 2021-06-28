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
                                    <li><b>Mobile Number:-</b> +91 {{$expert->mobile_number}}</li> 
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
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="">Appointment</h3>
                            </div>
                            <div class="col-lg-6" style="text-align: right;">
                                @if(count($appoinment)>0) <button onclick="payExpert('{{ucwords($expert->full_name)}}','{{$expert->user_id}}','{{$amountLeft}}' )" class="btn btn-primary"> Pay Amount</button> @endif
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="row"> 
                            <table class="table table-bordered mb-4 table-hover">
                                <thead> 
                                    <tr>  
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @if(count($appoinment)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($appoinment as $aGetData) 
                                            <tr> 
                                                <td>{{$aGetData->appoinment_no}}</td>
                                                <td>{{$aGetData->name}}</td>
                                                <td>{{date('d M,Y',strtotime($aGetData->date))}}</td>
                                                <td>{{date('h:i A',strtotime($aGetData->time)) .' - '. date("h:i A",strtotime('+1 hours',strtotime($aGetData->time)))}}</td>
                                                <td>{{ucwords(strtolower(array_search($aGetData->status,config('constant.STATUS'))))}}</td>
                                                <td><i class="fas fa-rupee-sign"></i> {{number_format($aGetData->amount,2,'.',',')}}</td>
                                                <td><span class="view-icon"><a href="{{route('adminappoinment.show',$aGetData->appointment_id)}}" title="Details"><i class="fas fa-eye"></i></a></span> </td> 
                                            </tr> 
                                        @php $i++; @endphp
                                        @endforeach 
                                    @else
                                        <tr> 
                                            <td colspan="7">No Record Found</td>
                                        </tr> 
                                    @endif  
                                </tbody>
                            </table> 
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
    <div class="modal fade" id="payexpertModal" tabindex="-1" role="dialog" aria-labelledby="payexpertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pay to <b class="name"></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <form method="POST" id="payExpert" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="hidden" name="userid" id="userid" value="{{old('userid')}}">

                    <div class="modal-body"> 
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Amount </label>
                                <input class="form-control" maxlength="9" type="number" name="amount" id="amount" placeholder="Enter Amount" value="{{old('amount')}}">
                                <span class="text-danger" id="amount-error"></span>
                            </div>
                        </div>  
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Transaction Id </label>
                                <input class="form-control" type="text" name="transaction_id" maxlength="40" id="transaction_id" placeholder="Enter Transaction Id" value="{{old('transaction_id')}}">
                                <span class="text-danger" id="transaction_id-error"></span>
                            </div>
                        </div>  
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Transaction Date </label>
                                <input class="form-control" type="date" min="{{date('Y-m-d')}}" name="transaction_date" id="transaction_date" placeholder="Enter Transaction Date" value="{{old('transaction_date')}}">
                                <span class="text-danger" id="transaction_date-error"></span>
                            </div>
                        </div> 
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Payment Mode </label>
                                <select class="form-control" id="exampleFormControlSelect1" name="payment_mode" id="payment_mode">
                                    <option value="">Select Payment Mode</option>
                                    @foreach(config('constant.PAYMENT_MODE') as $value => $key)
                                        <option {{ old('payment_mode') == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                    @endforeach
                                </select> 
                                <span class="text-danger" id="payment_mode-error"></span>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection    
