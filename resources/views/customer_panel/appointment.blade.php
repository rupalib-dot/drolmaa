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
                                <h3>My Appointments</h3>
                                <a href="{{route('appointment.index',['type'=>'current'])}}"> <button class="@if(!isset($request['type']) || $request['type'] == 'current') curent-appoint @else previous-appoint @endif">Current Appointment</button></a>
                                <a href="{{route('appointment.index',['type'=>'previous'])}}"> <button class="@if($request['type'] == 'previous') curent-appoint @else previous-appoint @endif">Previous Appointment</button></a>
                                <form action="{{route('appointment.index')}}" class="form-appoint">

                                    <input type="date" name="from_date" value="{{old('from_date',$request['from_date'])}}" class="">

                                    <input type="date" name="to_date" value="{{old('to_date',$request['to_date'])}}" class="">
                                    <select  name="payment_type" style="border: 1px solid var(--black1);padding: 8px;">
                                        <option value="">Select Payment</option>
                                        @foreach(config('constant.PAYMENT_MODE') as $value => $key)
                                            <option {{ old('payment_type',$request['payment_type']) == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="filter" style="margin-left:0px">Filter</button> 
                                    <a href="{{url('appointment')}}"> <button type="button" class="filter" style="margin-left:0px">Clear </button></a>
                                </form>
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Expert Name</th>
                                            <th>Plan</th>
                                            <th>Designation</th>
                                            <th>Payment</th>
                                            <td>Amount</td>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($appointment_list)>0)
                                        @foreach($appointment_list as $appointment)
                                            <tr>
                                                <td>{{$appointment->appoinment_no}}</td>
                                                <td>{{date('M d,Y',strtotime($appointment->date))}}</td>
                                                <td>{{date('h:i A',strtotime($appointment->time)) .' - '. date("h:i A",strtotime('+1 hours',strtotime($appointment->time)))}}</td>
                                                <td>{{$appointment->expertUsers->full_name}}</td>
                                                <td>{{ucwords(strtolower(array_search($appointment->plan,config('constant.PLAN'))))}}</td>
                                                <td>{{$appointment->designations->designation_title}}</td>
                                                <td>{{ucwords(strtolower(array_search($appointment->payment_mode,config('constant.PAYMENT_MODE'))))}}</td>
                                                <td>{{$appointment->amount}}</td>
                                                <td>
                                                
                                               <?php  $time1 = strtotime(date('Y-m-d H:i:s'));$time2 = strtotime(date('Y-m-d H:i:s',strtotime($appointment->date.' '.$appointment->time))); $difference = round(($time2 - $time1) / 3600);?>
                                                    @if($appointment->status == config('constant.STATUS.PENDING') || $appointment->status == config('constant.STATUS.ACCEPTED'))
                                                        @if($difference >= 48)
                                                            <span onclick="return confirm('Are you sure you want to cancel this appoinment?')" class="view-icon" title="cancel"><a href="{{route('appointment.cancelAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.CANCELLED')])}}"><i class="fas fa-ban"></i></a></span>
                                                        @else
                                                            {{ucwords(strtolower(array_search($appointment->status,config('constant.STATUS'))))}}
                                                        @endif
                                                    @elseif($appointment->status == config('constant.STATUS.COMPLETED'))
                                                        @php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.APPOINMENT"),'module_id',$appointment->appointment_id);@endphp
                                                        @if(empty($exist))
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" onclick="addFeedback('{{$appointment->expert}}','{{$appointment->appointment_id}}','{{config("constant.FEEDBACK.APPOINMENT")}}')"><i class="flaticon-view-details"></i></a></span> 
                                                        @else
                                                            <span class="view-icon" title="feedback"><a href="{{route('customer.feedback',['module_id'=>$appointment->appointment_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>$appointment->expert,'module_type'=>config('constant.FEEDBACK.APPOINMENT')])}}"><i class="flaticon-view-details"></i></a></span> 
                                                        @endif
                                                    @else
                                                        {{ucwords(strtolower(array_search($appointment->status,config('constant.STATUS'))))}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No Record Found</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="paginationPara">  
                            {{$appointment_list->appends($request->all())->render()}}
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
@include('include.modal')
 
 
  