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
                                        <th>Phone</th> 
                                        <th>Email</th> 
                                        <th style="width: 250px;">Message</th>
                                        <th>Module Type</th>
                                        <th>Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($contact_enquiery)>0) 
                                        @php $i=1; @endphp
                                        @foreach($contact_enquiery as $aGetData) 
                                            <tr> 
                                                <td>{{$i}}</td>
                                                <td>{{$aGetData->name}}</td>
                                                <td>{{$aGetData->phone}}</td>
                                                <td>{{$aGetData->email}}</td>
                                                <td>{{$aGetData->message}}</td>
                                                <td>{{ucwords(strtolower(array_search($aGetData->module_type,config('constant.ENQUIERY'))))}}</td>
                                                <td>{{date('d M,Y H:i A',strtotime($aGetData->created_at))}}</td>
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
                            {{$contact_enquiery->appends($request->all())->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
