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
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">My Availability</h3> 
                                <div class="row" style="margin-bottom:20px">
                                    <div class="col-lg-12">
                                        {{-- <a href="{{route('availabilty.create')}}"> <button type="button" style="background-color: #ba4811;border-color: #ba4811;" class="filter">Add Availability</button></a> --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="float-lg-right filter btn btn-primary" style="background-color: #ba4811;border-color: #ba4811;" data-toggle="modal" data-target="#exampleModal">Add Availability</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-light" id="exampleModalLabel">Add Availability</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-left mt-3">
                                                <h3 class="text-left">Date</h3>
                                                <form action="{{route('availabilty.store')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">From</label>
                                                      <input type="date" value="{{old('startDate')}}" min="{{date('Y-m-d',strtotime('+1 days',strtotime(date('Y-m-d'))))}}" max="{{date('Y-m-d',strtotime('+15 days',strtotime(date('Y-m-d'))))}}" name="startDate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputPassword1">To</label>
                                                      <input type="date" value="{{old('endDate')}}" min="{{date('Y-m-d',strtotime('+1 days',strtotime(date('Y-m-d'))))}}" max="{{date('Y-m-d',strtotime('+15 days',strtotime(date('Y-m-d'))))}}" name="endDate" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Time Slot</label> 
                                                        <ul style="overflow-x: auto;height: 150px;">
                                                        <!-- <select multiple class="form-control" name="time[]" id=""> -->
                                                            <?php  
                                                                $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                foreach($range as $time){ 
                                                                    $hr = date("h:i A",$time);
                                                                    $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?> 
                                                                        <li><input type="checkbox" name="time[]" value="{{date('H',$time).'_'.$hr}}" class="avail-regular"></td>
                                                                            {{$hr .' - '.$OnehrDiff}}</li>
                                                            <?php } ?> </ul>
                                                        <!-- </select> -->
                                                      </div>
                                                    
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <table class="table-responsive table table-bordered appoint-table"  style="display: inline-table;">
                                    <thead>
                                        <tr>  
                                            <th>Day</th> 
                                            <th>Date</th>
                                            <th>Slot Available</th> 
                                            <th>Slot Booked</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($avail_slots)>0)
                                            <?php $begin = new DateTime( date('Y-m-d') );
                                                $end   = new DateTime(date('Y-m-d',strtotime('+14 days',strtotime(date('Y-m-d')))));
                                                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                    $date = $i->format("Y-m-d"); 
                                                    $availabilityNote = CommonFunction::GetMultiWhereData('availability','date',$date,'user_id',Session::get('user_id'));
                                                    if(empty($availabilityNote)){
                                                        $notes = "";
                                                        $exist=0;
                                                    }else{
                                                        $notes = $availabilityNote->note;
                                                        $exist = 1;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>{{date('l',strtotime($date))}}</td>
                                                        <td>{{date('d M, Y',strtotime($date))}}</td> 
                                                        <td>@php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.AVAILABLE')); @endphp @if($count == 0) No Slot Available @else {{$count}} Slots Available @endif</td> 
                                                        <td>@php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.BOOKED')); @endphp @if($count == 0) No Slot Booked @else {{$count}} Slots Booked @endif</td> 
                                                        <td>
                                                            @if($exist == 1)
                                                                <span class="view-icon" title="Note"><a style="cursor:pointer" href="{{route('deleteAvailability',['id'=>$date])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt"></i></a></span> 
                                                                <span class="view-icon" title="Note"><a style="cursor:pointer" onclick="addNote('{{$date}}','{{$notes}}')"><i class="far fa-comments"></i></a></span> 
                                                            @endif
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" href="{{route('availabilty.edit',$date)}}"><i class="fas fa-edit"></i></a></span>
                                                        </td>
                                                    </tr>
                                            <?php } ?>
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
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
 
<script>
function addNote(availability_id,note){
    $("#noteModal #availability_id").val(availability_id);
    $("#noteModal #note").val(note);
    $("#noteModal").modal('show');
}
</script>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel">Add Start Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
             
            <form method="POST" id="notesubmit" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <input id="availability_id" name="availability_id" type="hidden"> 
                     
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="note" id="note" minlength="5" maxlength="250" required rows="3" placeholder="Message">{{old('message')}}</textarea>
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
                url: "{{route('expavailabiltyNote')}}",
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