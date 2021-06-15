@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Order Listing </h4>
                            </div>
                        </div>
                    </div>
                    <!-- <form action="" method="GET">
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" maxlenght="6" class="form-control mb-3 mb-md-0" name="coupon_code" placeholder="Coupon Code" value="{{$request->coupon_code}}" onkeypress="return IsAlphaNum(event, this.value, '6')"> 
                                </div>
                                <div class="col-md-4 d-flex">
                                    <button class="btn btn-primary mr-3" type="submit">
                                        Filter
                                    </button>
                                    <button class="btn btn-danger" type="button" id="ClearFilter">
                                        Clear Filter
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>  
                                    <tr> 
                                        <th>Order No</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                        <th>Status</th> 
                                        <th>Payment Type</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @if(count($order)>0)
                                        @foreach($order as $getData)
                                            <tr>
                                                <td>{{$getData->order_no}}</td> 
                                                <td>{{CommonFunction::GetSingleField('users','full_name','user_id',$getData['user_id'])}}</p>
                                                <td>{{date('M d, Y',strtotime($getData->created_at))}}</td>
                                                <td>{{array_search($getData['order_status'],config('constant.STATUS'))}}</td> 
                                                <td>{{array_search($getData['payment_type'],config('constant.PAYMENT_MODE'))}}</td>
                                                <td><i class="fas fa-rupee-sign"></i> {{$getData->grand_total}}</td>
                                                <td class="cancel-icon">
                                                    <span class="view-icon"><a href="{{route('adminOrder.show',$getData->order_id)}}" title="Details"><i class="fas fa-eye"></i></a></span> 
                                                    @if($getData->order_status == config('constant.STATUS.PENDING')) 
                                                        <span onclick="return confirm('Are you sure you want to cancel this order?')" class="view-icon" title="Cancel"><a href="{{route('change-order-status',['id'=>$getData->order_id,'status'=>config('constant.STATUS.CANCELLED')])}}"><i class="far fa-times-circle"></i></a></span>
                                                        <span onclick="return confirm('Are you sure you want to accept this order?')" class="view-icon" title="Accept"><a href="{{route('change-order-status',['id'=>$getData->order_id,'status'=>config('constant.STATUS.ACCEPTED')])}}"><i class="far fa-check-square"></i></a></span>
                                                    @elseif($getData->order_status == config('constant.STATUS.ACCEPTED'))
                                                        <span onclick="return confirm('Are you sure you want to complete this order?')" class="view-icon" title="Complete"><a href="{{route('change-order-status',['id'=>$getData->order_id,'status'=>config('constant.STATUS.COMPLETED')])}}"><i class="far fa-check-circle"></i></a></span>
                                                     
                                                    @endif
                                                </td>
                                            </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td  colspan="6">No order available</td>
                                        </tr> 
                                    @endif
                                </tbody>
                            </table>
                        </div> 
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$order->appends($request->all())->render('vendor.pagination.custom')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
 