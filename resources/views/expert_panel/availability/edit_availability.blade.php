@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-md-10">
                            <div class="dashboard-panel">
                            @include('include.validation_message')
                                @include('include.auth_message')
                                <h3>Edit Your Availability</h3>
                                <p class="schedule-choose">Edit a shedule that you can apply to your event types </p> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="{{route('availabilty.update',$id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                            <div class="appoinment-available" id="availability-section">
                                                <div class="appoinment-month" id="availability-section">
                                                    <ul> 
                                                        <li><a href="">{{date('d M, Y',strtotime($id))}}</a> 
                                                    </ul>
                                                </div> 

                                                <div class="appoinment-hours">
                                                    <table style="width:100%" class="table-time">
                                                        <tbody>  
                                                            <?php if($id == date('Y-m-d')){
                                                            // date_default_timezone_set("Asia/Kolkata");
                                                                $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                foreach($range as $time){ 
                                                                    if(date("H",$time) > date('H')){
                                                                        $hr = date("h:i A",$time); 
                                                                        $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?>
                                                                        @php $slots = CommonFunction::GetDateSlotStatus('availability','time',date('H',$time),'date',$id,'user_id',Session::get('user_id')); @endphp
                                                                        <tr> 
                                                                            <td><input type="checkbox" name="time[]" value="{{date('H',$time).'_'.$hr}}" @if(count($avail_slots)>0) @foreach($avail_slots as $dateavail) @if($dateavail['time'] == date('H',$time)) checked @else @endif @if($slots == config('constant.AVAIL_STATUS.BOOKED')) disabled  style="background-color: grey;" @endif @endforeach @endif  class="avail-regular"></td>
                                                                            <td> {{$hr .' - '.$OnehrDiff}}</td>
                                                                            <td> {{array_search($slots,config('constant.AVAIL_STATUS'))}} </td>
                                                                        </tr> 
                                                            <?php }}} else{
                                                                 $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                 foreach($range as $time){ 
                                                                     $hr = date("h:i A",$time); 
                                                                     $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?>
                                                                     @php $slots = CommonFunction::GetDateSlotStatus('availability','time',date('H',$time),'date',$id,'user_id',Session::get('user_id')); @endphp
                                                                    <tr> 
                                                                        <td><input type="checkbox" name="time[]" value="{{date('H',$time).'_'.$hr}}" @if(count($avail_slots)>0) @foreach($avail_slots as $dateavail) @if($dateavail['time'] == date('H',$time)) checked @else @endif @if($slots == config('constant.AVAIL_STATUS.BOOKED')) disabled  style="background-color: grey;" @endif @endforeach @endif  class="avail-regular"></td>
                                                                        <td> {{$hr .' - '.$OnehrDiff}}</td>
                                                                        <td> {{array_search($slots,config('constant.AVAIL_STATUS'))}} </td>
                                                                    </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="mb-3"> 
                                            <button class="login1 btn" type="submit" name="submit">Update</button>
                                            </div>
                                        </form>
                                    </div> 
                                </div>
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
 