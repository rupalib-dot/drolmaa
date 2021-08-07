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
                                <h4> Workshops Listing </h4>
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
                                        <th>Title</th> 
                                        <th>Experts</th>  
                                        <th>Designation</th>  
                                        <th>Price</th>
                                        <th>Date</th> 
                                        <th>Time</th> 
                                        <th>Booking Counts</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @if(count($workshop)>0) 
                                        @php $i=1; @endphp 
                                        @foreach($workshop as $aGetData) 
                                            <tr> 
                                                <td>{{$i}}</td>
                                                <td>{{$aGetData->title}}</td> 
                                                <td>{{$aGetData->expertUsers->full_name}}</td>
                                                <td>{{$aGetData->designations->designation_title}}</td> 
                                                <td><i class="fas fa-rupee-sign"></i> {{number_format($aGetData->price,2,'.',',')}}</td>
                                                <td>{{date('d M,Y',strtotime($aGetData->date))}}</td> 
                                                <td>{{date('H:i A',strtotime($aGetData->time))}}</td>
                                                <td>{{CommonFunction::workshopBookedCount($aGetData->workshop_id)}}</td>
                                                <td>
                                                    <span class="view-icon" title="delete"><a onclick="return confirm('Are you sure you want to delete this workshop?')" href="{{route('workshop.delete',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                    <span class="view-icon" title="Edit"><a href="{{route('workshop.edit',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="fas fa-edit"></i></a></span> 
                                                    <span class="view-icon" title="view"><a href="{{route('workshop.show',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="fas fa-eye"></i></a></span>   
                                                </td>
                                            </tr> 
                                        @php $i++; @endphp
                                        @endforeach 
                                    @else
                                        <tr> 
                                            <td colspan="8">No Record Found</td>
                                        </tr> 
                                    @endif  
                                </tbody>
                            </table>
                        </div> 
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$workshop->appends($request->all())->render('vendor.pagination.custom')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
