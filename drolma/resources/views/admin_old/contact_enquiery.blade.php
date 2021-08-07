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
                            <div class="table-responsive mb-4 mt-4" style="overflow-x: scroll;"> 
                                <table id="alter_pagination" style="width:100%">
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
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   