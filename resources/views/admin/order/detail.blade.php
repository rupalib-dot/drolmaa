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
                                <h4>{{$title}}</h4>
                            </div>
                        </div>
                    </div> 
                </div>   
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Order NO:- {{$order['order_no']}}</h3> 
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="contacts-block list-unstyled" style="max-width: 100%;">
                                    <li><b>Name :- </b>{{$order['full_name']}}</li>
                                    <li><b>Company Name :- </b>{{$order['company_name']}}</li>
                                    <li><b>Gender :- </b>{{array_search($order['user_gender'],config('constant.GENDER'))}}</li> 
                                    <li><b>Mobile Number :-</b> {{$order['mobile_number']}}</li>
                                    <li><b>Payment Id :- </b>{{$order['payment_id']}}</li>
                                    <li><b>Payment Mode :- </b>{{array_search($order['payment_type'],config('constant.PAYMENT_MODE'))}}</li>
                                    <li><b>Payment Status :- </b>{{$order['payment_status']}}</li>  
                                    <li><b>Refund Id :- </b>{{$order['refund_id']}}</li>
                                    <li><b>Refund Status :- </b>{{$order['refund_status']}}</li>
                                    <li><b>Refund Amount :- </b>{{$order['refund_amount']}}</li> 
                                </ul>
                            </div> 
                            <div class="col-lg-6">
                                <ul class="contacts-block list-unstyled" style="max-width: 100%;"> 
                                    <li><b>Grand Total :- </b>{{$order['grand_total']}}</li> 
                                    <li><b>Pincode :- </b>{{$order['pincode']}}</li> 
                                    <li><b>Email Address :-</b> {{$order['email_address']}}</li> 
                                    <li><b>Address Line1 :-</b> {{$order['address1']}}</li>
                                    <li><b>Address Line2 :- </b>{{$order['address2']}}</li> 
                                    <li><b>Country :-</b> {{CommonFunction::GetSingleField('country','country_name','country_id',$order['country_id'])}}</li>
                                    <li><b>State :- </b>{{CommonFunction::GetSingleField('state','state_name','state_id',$order['state_id'])}}</li>
                                    <li><b>City :-</b> {{CommonFunction::GetSingleField('city','city_name','city_id',$order['city_id'])}}</li>  
                                    <li><b>Order Status :- </b>{{array_search($order['order_status'],config('constant.STATUS'))}}</li>
                                    <li><b>Order Date :-</b> {{date('M d, Y',strtotime($order['created_at']))}}</li>
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
                                                <h4>{{CommonFunction::GetSingleField('users','full_name','user_id',$feedback->feedback_by)}}</h4>
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
                                    @endforeach @else
                                    No record found
                                @endif 
                            </div>
                        </div>            
                    </div>
                </div> 
                <div class="statbox widget box box-shadow mb-1"> 
                    <div class="widget-content widget-content-area">
                        <div class="row">
                        <table class="table table-bordered mb-4 table-hover">
                                <thead>  
                                    <tr> 
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th> 
                                        <th scope="col">Price</th> 
                                        <th scope="col">Total Price</th>  
                                    </tr>
                                </thead>
                                <tbody>  
                                    @if(count($orderDetail)>0)
                                        @foreach($orderDetail as $getOrderData)
                                            <tr>
                                                <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$getOrderData->product_id); ?>
                                                <td><img style="    width: 100px; height: 100px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="img-pro">  </td>
                                                <td><p class="fnt mt-2">{{$getOrderData->product_name}}</p></td>
                                                <td class="py-0"> {{$getOrderData->quantity}} </td>
                                                <td class="py-0"> <p class="indrupee"> &#8377 <span class="yerupee">{{$getOrderData->price}}</span></p> </td>
                                                <td class="text-red py-0"> <p class="indrupee">&#8377 <span class="yerupee">{{$getOrderData->total_price}}</span></p></td>
                                            </tr>
                                        @endforeach 
                                    @else
                                        <tr>
                                            <td colspan="5"> No Record Found</td> 
                                        </tr> 
                                    @endif
                                </tbody>
                            </table>
                        </div>             
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection  
