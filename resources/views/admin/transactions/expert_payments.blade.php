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
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{$title}} </h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6" style="text-align:right">
                                <a href="{{url('admin/transactions/appointment')}}"><button class="btn btn-primary" type="button">Back</button></a>
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
                                @if(count($expertPayment)>0)  
                                    <table class="table table-bordered mb-4 table-hover">
                                    <thead>  
                                        <tr> 
                                            <th>Total Amount Paid:- {{number_format($totalPaidamount,2,'.',',')}}</th> 
                                        </tr>
                                    </thead> 
                                </table>
                                @endif  
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
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Payment Id</th>
                                        <th>Payment Mode</th>
                                        <th>Amount</th> 
                                        <th>Expert</th> 
                                    </tr>
                                </thead>
                                <tbody>  
                                    @if(count($expertPayment)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($expertPayment as $aGetData)  
                                            <tr>  
                                                <td> {{$i}} </td>
                                                <td>{{date('d M, Y',strtotime($aGetData->transaction_date))}}</td>
                                                <td>{{$aGetData->transaction_id}}</td> 
                                                <td>{{array_search($aGetData->payment_mode,config('constant.PAYMENT_MODE'))}}</td>
                                                <td>{{number_format($aGetData->amount,2,'.',','}}</td> 
                                                <td><a style="color:blue" href="{{route('adminexpert.show',$aGetData->user_id)}}">{{CommonFunction::GetSingleField('users','full_name','user_id',$aGetData->user_id)}}</a></td>
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
                            {{$expertPayment->appends($request->all())->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
