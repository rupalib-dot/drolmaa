@include('admin.layouts.header')    
 
 <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('admin.layouts.sidebar')   

         <div id="content" class="main-content"> 
             <div class="page-header" style = "margin-left: 25px">
                    <div class="page-title">
                        <h3>{{$title}}</h3>
                    </div>
                </div>
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;"> 
                
            <!-- <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;">                      -->
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">     
                                @include('admin.layouts.validation_message')
                                @include('admin.layouts.auth_message')      
                            </div> 
                                <a class="btn btn-primary" href="{{route('workshop.create')}}">Add Workshop</a> 
                            <div class="table-responsive mb-4 mt-4" style="overflow-x: scroll;"> 
                                <table id="alter_pagination" style="width:100%"> 
                                    <thead> 
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Title</th> 
                                            <th>Expert</th>  
                                            <th>Designation</th>  
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Time</th> 
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
                                                    <td>{{$aGetData->price}}</td>
                                                    <td>{{date('d M,Y',strtotime($aGetData->date))}}</td>
                                                    <td>{{date('H:i A',strtotime($aGetData->time))}}</td>
                                                    <td>
                                                        <span class="view-icon" title="delete"><a onclick="return confirm('Are you sure you want to delete this workshop?')" href="{{route('workshop.delete',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                        <span class="view-icon" title="Edit"><a href="{{route('workshop.edit',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="fas fa-edit"></i></a></span>  
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
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   