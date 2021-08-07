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
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   