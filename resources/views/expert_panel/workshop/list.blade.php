@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-lg-10">
                            <div class="dashboard-panel" style="padding-top: 20px;">
                                <div class="container">
                                    <div class="justify-content-center row">
                                        <div class="col-md-3">
                                            <a href="{{route('expworkshop.index',['status'=>$request['status'],'user'=>'admin'])}}"> <button class="w-100 @if(!isset($request['user']) || $request['user'] == 'admin') curent-appoint @else previous-appoint @endif">Admin Workshop</button></a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{route('expworkshop.index',['status'=>$request['status'],'user'=>'expert'])}}"> <button class="w-100 @if($request['user'] == 'expert') curent-appoint @else previous-appoint @endif">My Workshop</button></a>
                                        </div>   
                                    </div>    
                                </div> 
                                            {{-- <a href="{{route('expworkshop.index',['status'=>$request['status'],'user'=>'admin'])}}"> <button class="@if(!isset($request['user']) || $request['user'] == 'admin') curent-appoint @else previous-appoint @endif">Admin Workshop</button></a>
                                            <a href="{{route('expworkshop.index',['status'=>$request['status'],'user'=>'expert'])}}"> <button class="@if($request['user'] == 'expert') curent-appoint @else previous-appoint @endif">My Workshop</button></a>
                                            --}}
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <div class="">
                                    <div class="mt-3 justify-content-around row">
                                        <div class="col-md-3">
                                            <a href="{{route('expworkshop.index',['status'=>'upcoming','user'=>$request['user']])}}"> <button class="w-100 @if(!isset($request['status']) || $request['status'] == 'upcoming') curent-appoint @else previous-appoint @endif">Upcoming Workshop</button></a>
                                        </div>
                                        <div class="col-md-3">
                                           <a href="{{route('expworkshop.index',['status'=>'previous','user'=>$request['user']])}}"> <button class="w-100 @if($request['status'] == 'previous') curent-appoint @else previous-appoint @endif">Previous Workshop</button></a>
                                        </div>   
                                    </div> 
                                    <div class="justify-content-between row">
                                        <div class="align-self-center col-md-3">
                                <h3> @if($request['user'] == 'expert') My @else Admin  @endif Workshops</h3>

                                        </div>
                                        <div class="col-md-8">
                                            <form action="{{route('expappointment.index')}}" class="form-appoint">

                                                <input style="margin-right: 5px !important;" type="date" name="from_date" value="{{old('from_date',$request['from_date'])}}" class="mr-3">
            
                                                <input style="margin-right: 5px !important;" type="date" name="to_date" value="{{old('to_date',$request['to_date'])}}">
                                                <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                                <a href="{{url('expert/expappointment')}}"> <button type="button" class="filter"  style="margin-left:0px">Clear</button></a>
                                            </form>    
                                        </div>     
                                    </div>   
                                </div> 
                                {{-- <a href="{{route('expworkshop.index',['status'=>'upcoming','user'=>$request['user']])}}"> <button class="@if(!isset($request['status']) || $request['status'] == 'upcoming') curent-appoint @else previous-appoint @endif">Upcoming Workshop</button></a>
                                <a href="{{route('expworkshop.index',['status'=>'previous','user'=>$request['user']])}}"> <button class="@if($request['status'] == 'previous') curent-appoint @else previous-appoint @endif">Previous Workshop</button></a> --}}
                                <!-- <form action="{{route('expappointment.index')}}" class="form-appoint">

                                    <input style="margin-right: 5px !important;" type="date" name="from_date" value="{{old('from_date',$request['from_date'])}}" class="mr-3">

                                    <input style="margin-right: 5px !important;" type="date" name="to_date" value="{{old('to_date',$request['to_date'])}}">
                                    <select  name="payment_type" style="border: 1px solid var(--black1);padding: 9px;margin-right: 5px !important;">
                                    <option value="">Select Payment</option>
                                        @foreach(config('constant.PAYMENT_MODE') as $value => $key)
                                            <option {{ old('payment_type',$request['payment_type']) == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                    <a href="{{url('expert/expappointment')}}"> <button type="button" class="filter"  style="margin-left:0px">Clear</button></a>
                                </form> -->
                                <table class="table table-bordered appoint-table" style="width:100%; margin-top:20px">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Title</th> 
                                            <!-- <th>Experts</th>  
                                            <th>Designation</th>   -->
                                            <th>Price</th>
                                            <th>Start Date</th> 
                                            <th>End Date</th> 
                                            <th>Time</th> 
                                            <th>Booking Counts</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($Workshops)>0) 
                                            @php $i=1; @endphp 
                                            @foreach($Workshops as $aGetData) 
                                                <tr> 
                                                    <td>{{$i}}</td>
                                                    <td>{{$aGetData->title}}</td> 
                                                    <!-- <td>{{$aGetData->expertUsers->full_name}}</td>
                                                    <td>{{$aGetData->designations->designation_title}}</td>  -->
                                                    <td><i class="fas fa-rupee-sign"></i> {{number_format($aGetData->price,2,'.',',')}}</td>
                                                    <td>{{date('d M,Y',strtotime($aGetData->start_date))}}</td>
                                                    <td>{{date('d M,Y',strtotime($aGetData->date))}}</td> 
                                                    <td>{{date('H:i A',strtotime($aGetData->time))}}</td>
                                                    <td>{{CommonFunction::workshopBookedCount($aGetData->workshop_id)}}</td>
                                                    <td>
                                                        <span class="view-icon" title="delete"><a onclick="return confirm('Are you sure you want to delete this workshop?')" href="{{route('expworkshop.delete',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                        <span class="view-icon" title="Edit"><a href="{{route('expworkshop.edit',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="fas fa-edit"></i></a></span> 
                                                        <span class="view-icon" title="view"><a href="{{route('expworkshop.show',$aGetData->workshop_id)}}" style="cursor:pointer"><i class="fas fa-eye"></i></a></span>   
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
                            <div class="paginationPara">  
                            {{$Workshops->appends($request->all())->render('vendor.pagination.custom')}}
                                <!-- <ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Previouss</button>
                                        </a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Next</button>
                                        </a></li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
