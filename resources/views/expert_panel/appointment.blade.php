@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-md-10">
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3>My Appointments</h3>
                                <a href="{{route('expappointment.index',['type'=>'current'])}}"> <button class="@if(!isset($request['type']) || $request['type'] == 'current') curent-appoint @else previous-appoint @endif">Current Appointment</button></a>
                                <a href="{{route('expappointment.index',['type'=>'previous'])}}"> <button class="@if($request['type'] == 'previous') curent-appoint @else previous-appoint @endif">Previous Appointment</button></a>
                                <form action="{{route('expappointment.index')}}" class="form-appoint">

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
                                </form>
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Client Name</th>
                                            <th>Plan</th>
                                            <th>Designation</th>
                                            <th>Appointment type</th> 
                                            <th>Amount</th>
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
                                                <td>{{$appointment->users->full_name}}</td>
                                                <td>{{ucwords(strtolower(array_search($appointment->plan,config('constant.PLAN'))))}}</td>
                                                <td>{{$appointment->designations->designation_title}}</td>
                                                <td>{{ucwords(strtolower(array_search($appointment->payment_mode,config('constant.PAYMENT_MODE'))))}}</td>
                                                <td><i class="fas fa-rupee-sign"></i> {{number_format($appointment->amount,2,'.',',')}}</td>
                                                <td>
                                                    <span class="view-icon" title="Note"><a style="cursor:pointer" onclick="addNote('{{$appointment->appointment_id}}','{{$appointment->note}}')"><i class="far fa-comments"></i></a></span> 

                                                    <?php  $time1 = strtotime(date('Y-m-d H:i:s'));$time2 = strtotime(date('Y-m-d H:i:s',strtotime($appointment->date.' '.$appointment->time))); $difference = round(($time2 - $time1) / 3600);?>
                                                    @if($appointment->status == config('constant.STATUS.PENDING') || $appointment->status == config('constant.STATUS.ACCEPTED'))
                                                        @if($difference >= 48)
                                                            <!-- <span onclick="return confirm('Are you sure you want to cancel this appoinment?')" class="view-icon" title="Cancel"><a href="{{route('expappointment.changeStatusAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.CANCELLED')])}}"><i class="fas fa-ban"></i></a></span> -->
                                                            <span onclick="return confirm('Are you sure you want to reject this appoinment?')" class="view-icon" title="Reject"><a href="{{route('expappointment.changeStatusAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.REJECTED')])}}"><i class="far fa-times-circle"></i></a></span>
                                                            <span onclick="return confirm('Are you sure you want to accept this appoinment?')" class="view-icon" title="Accept"><a href="{{route('expappointment.changeStatusAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.ACCEPTED')])}}"><i class="far fa-check-square"></i></a></span>
                                                        @else
                                                            @if($appointment->status == config('constant.STATUS.PENDING'))
                                                                <span onclick="return confirm('Are you sure you want to reject this appoinment?')" class="view-icon" title="Reject"><a href="{{route('expappointment.changeStatusAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.REJECTED')])}}"><i class="far fa-times-circle"></i></a></span>
                                                                <span onclick="return confirm('Are you sure you want to accept this appoinment?')" class="view-icon" title="Accept"><a href="{{route('expappointment.changeStatusAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.ACCEPTED')])}}"><i class="far fa-check-square"></i></a></span>
                                                            @elseif($appointment->status == config('constant.STATUS.ACCEPTED'))
                                                                <span onclick="return confirm('Are you sure you want to complete this appoinment?')" class="view-icon" title="Complete"><a href="{{route('expappointment.changeStatusAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.COMPLETED')])}}"><i class="far fa-check-circle"></i></a></span>
                                                            @else
                                                                {{ucwords(strtolower(array_search($appointment->status,config('constant.STATUS'))))}}
                                                            @endif
                                                        @endif
                                                    @elseif($appointment->status == config('constant.STATUS.COMPLETED'))
                                                        @php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.APPOINMENT"),'module_id',$appointment->appointment_id);@endphp
                                                        @if(empty($exist))
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" onclick="addFeedback('{{$appointment->user_id}}','{{$appointment->appointment_id}}','{{config("constant.FEEDBACK.APPOINMENT")}}')"><i class="flaticon-view-details"></i></a></span> 
                                                        @else
                                                            <span class="view-icon" title="feedback"><a href="{{route('expert.feedback',['module_id'=>$appointment->appointment_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>$appointment->user_id,'module_type'=>config('constant.FEEDBACK.APPOINMENT')])}}"><i class="flaticon-view-details"></i></a></span> 
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
                            {{$appointment_list->appends($request->all())->render('vendor.pagination.custom')}}
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

<script>
function addNote(appoinment_id,note){
    $("#noteModal #appoinment_id").val(appoinment_id);
    $("#noteModal #description").val(note);
    $("#noteModal").modal('show');
}

function addFeedback(feedback_to,moduleId,moduleType){
    $("#exampleModal #module_id").val(moduleId);
    $("#exampleModal #module_type").val(moduleType);
    $("#exampleModal #feedback_to").val(feedback_to);
    $("#exampleModal").modal('show');
}
function ratingSelected(rating){  
    if(rating == 1){
        $('#rating1').addClass('active');
        $('#rating2').removeClass('active');
        $('#rating3').removeClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop("checked", true);
        $('#rating2').prop('checked', false);
        $('#rating3').prop('checked', false);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 2){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').removeClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', false);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 3){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 4){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').addClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', true);
        $('#rating5').prop('checked', false);
    }else if(rating == 5){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').addClass('active');
        $('#rating5').addClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', true);
        $('#rating5').prop('checked', true);
    }
}
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
             
            <form method="POST" id="feedback" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <input id="module_id" name="module_id" type="hidden">
                    <input id="module_type" name="module_type" type="hidden"> 
                    <input id="feedback_to" name="feedback_to" type="hidden"> 
                    
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <div class="sDoc_File"> 
                                <label for="exampleFormControlFile1">Rating </label>
                                <div class="row">
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating1" name="rating" data-id="1" class="form-control" value="1" id="rating">
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating2" name="rating" data-id="2" class="form-control" value="2" id="rating"> 
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating3" name="rating" data-id="3" class="form-control" value="3" id="rating"> 
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating4" name="rating" data-id="4" class="form-control" value="4" id="rating"> 
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating5" name="rating" data-id="5" class="form-control" value="5" id="rating">  
                                </div>
                                <span class="text-danger" id="rating-error"></span>
                            </div>  
                        </div>
                    </div> 
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="note" id="note" rows="3" placeholder="Message">{{old('message')}}</textarea>
                            <span class="text-danger" id="note-error"></span>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<script>
    $(document).ready(function (e) { 
        setInterval(function(){ $("div .alert").hide(); }, 4000); 

        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        
        $('#feedback').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{url('expert/expappointment-feedback')}}",
                data: formData,
                cache:false,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {     
                    window.location.reload();
                    alert(response.message);  
                },
                error: function(xhr,status,error){  
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    $("#note-error").text(err.errors.note); 
                    $("#rating-error").text(err.errors.rating);
                }
            });
        });
    });
</script>
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
             
            <form method="POST" id="notesubmit" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <input id="appoinment_id" name="appoinment_id" type="hidden"> 
                     
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="description" id="description" minlength="5" maxlength="250" required rows="3" placeholder="Message">{{old('message')}}</textarea>
                            <span class="text-danger" id="note-error"></span>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (e) { 
        setInterval(function(){ $("div .alert").hide(); }, 4000); 

        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        
        $('#notesubmit').submit(function(e) { 
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{route('expappointmentNote')}}",
                data: formData,
                cache:false,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {     
                    window.location.reload();
                    alert(response.message);  
                },
                error: function(xhr,status,error){  
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    $("#note-error").text(err.errors.description);  
                }
            });
        });
    });
</script>