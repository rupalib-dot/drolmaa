@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.client_sidebar')
                        <div class="col-md-9">
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">My Bookings</h3> 
                         
                                <form action="{{route('bookings.index')}}"class="form-appoint">
                                    <input type="date" name="from_date" value="{{$request['from_date']}}" class="">

                                    <input type="date" name="to_date" value="{{$request['to_date']}}" class="">
                                    <a href="#"> <button type="submit" class="filter" style="margin-left:0px">Filter</button></a>
                                    <a href="{{url('bookings')}}"> <button type="button" class="filter" style="margin-left:0px">Clear Filter</button></a>
                                    <a href="{{route('bookings.create')}}"> <button type="button" style="background-color: #ba4811;border-color: #ba4811;" class="filter">Add Booking</button></a>
                                </form>
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Expert Name</th>
                                            <th>Designation</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Price</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($booking_list)>0)
                                            @foreach($booking_list as $booking)
                                                <tr>
                                                    <td>{{$booking->booking_no}}</td>
                                                    <td>{{ucwords(strtolower(array_search($booking->module_type,config('constant.BOOKING'))))}}</td>
                                                    <td>{{$booking->title}}</td> 
                                                    <td>{{CommonFunction::GetSingleField('users','full_name','user_id',$booking->expert)}}</td>
                                                    <td>{{CommonFunction::GetSingleField('designation','designation_title','designation_id',$booking->designation)}}</td>
                                                    <td>{{date('M d,Y',strtotime($booking->date))}}</td>
                                                    <td>{{date('h:i A',strtotime($booking->time))}}</td>
                                                    <td><i class="fas fa-rupee-sign"></i> {{number_format($booking->price,2,'.',',')}}</td> 
                                                    <td>
                                                        @php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.BOOKING"),'module_id',$booking->booking_id);@endphp
                                                        @if(empty($exist))
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" onclick="addFeedback('{{$booking->expert}}','{{$booking->booking_id}}','{{config("constant.FEEDBACK.BOOKING")}}')"><i class="flaticon-view-details"></i></a></span> 
                                                        @else
                                                            <span class="view-icon" title="feedback"><a href="{{route('customer.feedback',['module_id'=>$booking->booking_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>$booking->expert,'module_type'=>config('constant.FEEDBACK.BOOKING')])}}"><i class="flaticon-view-details"></i></a></span> 
                                                        @endif 
                                                    </td>
                                                </tr>
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
                            {{$booking_list->appends($request->all())->render()}}
                                <!-- <ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button class="page-next">Previouss</button></a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button class="page-next">Next</button></a></li>
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
@include('include.modal')
 