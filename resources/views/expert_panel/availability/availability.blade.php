@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-md-9">
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">My Availability</h3> 
                                <div class="row" style="margin-bottom:20px">
                                    <div class="col-lg-6">
                                    </div>
                                    <div class="col-lg-6" style="text-align: right;">
                                        <a href="{{route('availabilty.create')}}"> <button type="button" style="background-color: #ba4811;border-color: #ba4811;" class="filter">Add Availability</button></a>
                                    </div>
                                </div>
                                <table class="table table-bordered appoint-table" style="width:100%">
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
                                                        <td>@php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.BOOKED')); @endphp @if($count == 0) No Slot Available @else {{$count}} Slots Available @endif</td> 
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
 