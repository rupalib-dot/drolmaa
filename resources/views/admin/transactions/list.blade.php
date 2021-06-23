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
                                <h4>{{ucwords($type)}} Transaction Listing </h4>
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
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                @if(count($transactions)>0)  
                                    <table class="table table-bordered mb-4 table-hover">
                                    <thead>  
                                        <tr>
                                            <?php if($type == 'order'){ ?>
                                                <th>Amount Earned</th>
                                                <th>Amount Refund</th>
                                                <th>Total Collection</th>  
                                            <?php }else if($type == 'registration'){ ?>
                                                <th>Total Collection</th>  
                                            <?php }else if($type == 'booking'){ ?>
                                                <th>Total Collection</th>    
                                            <?php }else if($type == 'appointment'){  ?>
                                                <th>Amount Earned</th>
                                                <th>Amount Refund</th>
                                                <th>Amount Paid To Expert</th>
                                                <th>Total Collection</th>   
                                                <th>Total Amount Left</th>   
                                            <?php  } ?> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr> 
                                            <?php if($type == 'order'){ ?>
                                                <td> {{number_format($amountearned,2,'.',',')}}</td> 
                                                <td> {{number_format($amountrefund,2,'.',',')}}</td>
                                                <td> {{number_format($TotalColection,2,'.',',')}} </td>  
                                            <?php }else if($type == 'registration'){ ?>
                                                <td> {{number_format($TotalColection,2,'.',',')}} </td>  
                                            <?php }else if($type == 'booking'){ ?>
                                                <td> {{number_format($TotalColection,2,'.',',')}} </td>  
                                            <?php }else if($type == 'appointment'){  ?>
                                                <td> {{number_format($amountearned,2,'.',',')}}</td> 
                                                <td> {{number_format($amountrefund,2,'.',',')}}</td>
                                                <td> {{number_format($totalPaidamount,2,'.',',')}} </td>
                                                <td> {{number_format($TotalColection,2,'.',',')}} </td> 
                                                <td> {{number_format(($TotalColection - $totalPaidamount),2,'.',',')}} </td>  
                                            <?php  } ?>
                                        </tr> 
                                    </tbody>
                                </table>
                                @endif  
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="statbox widget box box-shadow">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6" style="text-align:right">
                        <a href="{{route('pay-details')}}"><button class="btn btn-primary"> Amount Paid Details </button></a>
                    </div>
                </div> 
                    <div class="widget-content widget-content-area"> 
                        <div class="table-responsive"> 
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>  
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Payment Id</th>
                                        <th>Amount</th> 
                                        <?php if($type == 'order'){ ?>   
                                                <th>Refund Id</th>
                                                <th>Refund Amount</th>  
                                        <?php }else if($type == 'appointment'){ ?> 
                                                <th>Expert</th>
                                                <th>Refund Id</th>
                                                <th>Refund Amount</th>    
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @if(count($transactions)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($transactions as $aGetData)  
                                            <tr> 
                                                <?php if($type == 'order'){ ?>
                                                    <td><a style="color:blue" href="{{route('adminOrder.show',$aGetData->order_id)}}">{{$aGetData->order_no}}</a></td>
                                                    <td>{{date('d M, Y',strtotime($aGetData->created_at))}}</td>
                                                    <td>{{$aGetData->payment_id}}</td> 
                                                    <td>{{$aGetData->grand_total}}</td> 
                                                    <td>@if(!empty($aGetData->refund_id)) {{$aGetData->refund_id}} @else N/A @endif</td>
                                                    <td>@if(!empty($aGetData->amount_refund)) {{$aGetData->refund_amount}} @else N/A @endif</td>   
                                                <?php }else if($type == 'registration'){ ?>
                                                    <td><a style="color:blue" href="{{route('adminexpert.show',$aGetData->user_id)}}">{{$i}}</a></td>
                                                    <td>{{date('d M, Y',strtotime($aGetData->created_at))}}</td>
                                                    <td>{{$aGetData->payment_id}}</td>
                                                    <td>{{$aGetData->register_amount}}</td>
                                                <?php }else if($type == 'booking'){ ?>
                                                    <td><a style="color:blue" href="{{route('workshop.show',$aGetData->workshop_id)}}">{{$aGetData->booking_no}}</a></td>
                                                    <td>{{date('d M, Y',strtotime($aGetData->date))}}</td>
                                                    <td>{{$aGetData->payment_id}}</td> 
                                                    <td>{{$aGetData->price}}</td>
                                                <?php }else if($type == 'appointment'){  ?>
                                                    <td><a style="color:blue" href="{{route('adminappoinment.show',$aGetData->appointment_id)}}">{{$aGetData->appoinment_no}}</a></td>
                                                    <td>{{date('d M, Y',strtotime($aGetData->date))}}</td>
                                                    <td>{{$aGetData->payment_id}}</td> 
                                                    <td>{{number_format($aGetData->amount,2,'.',',')}}</td> 
                                                    <td><a style="color:blue" href="{{route('adminexpert.show',$aGetData->expert)}}">{{$aGetData->expertUsers->full_name}}</a></td> 
                                                    <td>@if(!empty($aGetData->refund_id)) {{$aGetData->refund_id}}  @else N/A @endif </td>
                                                    <td>@if(!empty($aGetData->amount_refund)) {{number_format($aGetData->amount_refund,2,'.',',')}}  @else N/A @endif</td>  
                                                <?php  } ?>
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
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$transactions->appends($request->all())->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
