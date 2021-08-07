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
        

@include('admin.layouts.footer')   