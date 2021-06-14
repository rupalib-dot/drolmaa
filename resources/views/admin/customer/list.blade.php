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
                                <h4>Customers</h4>
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
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Date Of Birth</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Gender</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @if(count($customers)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($customers as $aGetData) 
                                            <tr> 
                                                <td>{{$i}}</td> 
                                                <td>{{$aGetData->full_name}} </td>
                                                <td>{{$aGetData->email_address}}</td>
                                                <td>{{$aGetData->mobile_number}}</td> 
                                                <td>{{$aGetData->user_dob}}</td> 
                                                <td>{{CommonFunction::GetSingleField('country','country_name','country_id',$aGetData->country_id)}}</td>
                                                <td>{{CommonFunction::GetSingleField('state','state_name','state_id',$aGetData->state_id)}}</td>
                                                <td>{{CommonFunction::GetSingleField('city','city_name','city_id',$aGetData->city_id)}}</td>
                                                <td>{{array_search($aGetData->user_gender,config('constant.GENDER'))}}</td>
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
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
