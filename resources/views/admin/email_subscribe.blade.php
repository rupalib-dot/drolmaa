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
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($emailSubscribe)>0) 
                                        @php $i=1; @endphp
                                        @foreach($emailSubscribe as $aGetData) 
                                            <tr> 
                                                <td>{{$i}}</td>
                                                <td>{{CommonFunction::GetSingleField('users','full_name','user_id',$aGetData->user_id)}}</td> 
                                                <td>{{$aGetData->email}}</td>  
                                            </tr> 
                                        @php $i++; @endphp
                                        @endforeach 
                                    @else
                                        <tr> 
                                            <td colspan="3">No Record Found</td>
                                        </tr> 
                                    @endif  
                                </tbody>
                            </table>
                        </div>
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$emailSubscribe->appends($request->all())->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
