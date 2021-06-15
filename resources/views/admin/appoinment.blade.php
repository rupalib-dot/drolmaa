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
                                <h4>{{$title}}</h4>
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
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Customer</th> 
                                        <th style="width:110px">Expert</th>  
                                        <th>Plan</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Payment Mode</th> 
                                        <th>Payment Id</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($appoinment)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($appoinment as $aGetData) 
                                            <tr> 
                                                <td>{{$i}}</td>
                                                <td>{{$aGetData->name}}</td>
                                                <td>{{$aGetData->users->full_name}}</td>
                                                <td>{{$aGetData->expertUsers->full_name.' ('.$aGetData->designations->designation_title.')'}}</td> 
                                                <td>{{ucwords(strtolower(array_search($aGetData->plan,config('constant.PLAN'))))}}</td>
                                                <td>{{date('d M,Y',strtotime($aGetData->date))}}</td>
                                                <td>{{date('H:i A',strtotime($aGetData->time))}}</td>
                                                <td>{{ucwords(strtolower(array_search($aGetData->status,config('constant.STATUS'))))}}</td>
                                                <td>{{ucwords(strtolower(array_search($aGetData->payment_mode,config('constant.PAYMENT_MODE'))))}}</td>
                                                <td>{{$aGetData->payment_id}}</td> 
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
                            {{$appoinment->appends($request->all())->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
