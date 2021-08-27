@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{__('Manage Services')}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($record_list) > 0)
                                        @foreach($record_list as $record)
                                            <tr>
                                                <td style="max-width: 310px;">{{$record->services_title}}</td>
                                                <td style="max-width: 550px;">{{$record->services_detail}}</td>
                                                <td><img src="{{asset('public/services')}}/{{$record->services_photo}}" width="100" /></td>
                                                <td>{{date('d F, Y', strtotime($record->created_at))}}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <!-- <li><a href="{{route('services.edit',base64_encode($record->services_id))}}"  data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a></li> -->
                                                        <li>
                                                            <form action="{{route('services.destroy',base64_encode($record->services_id))}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <buttton type="submit" class="delete-user" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="5" align="center"><strong>No record's found</strong></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$record_list->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  