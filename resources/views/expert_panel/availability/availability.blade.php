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
                                                <form>
                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">From</label>
                                                      <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                      <small id="emailHelp" class="form-text text-muted">We'll never share your Details with anyone else.</small>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputPassword1">To</label>
                                                      <input type="date" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Time Slot</label>
                                                        <select class="form-control"name="time_slot" id="">
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                        </select>
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
                                <table class="table-responsive table table-bordered appoint-table" style="width:100%">
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
                                                    $date = $i->format("Y-m-d"); ?>
                                                    <tr>
                                                        <td>{{date('l',strtotime($date))}}</td>
                                                        <td>{{date('d M, Y',strtotime($date))}}</td> 
                                                        <td>@php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.AVAILABLE')); @endphp @if($count == 0) No Slot Available @else {{$count}} Slots Available @endif</td> 
                                                        <td>@php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.BOOKED')); @endphp @if($count == 0) No Slot Booked @else {{$count}} Slots Booked @endif</td> 
                                                        <td>
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
 