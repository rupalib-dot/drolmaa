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
                                <h3>Set Your Availability</h3>
                                <p class="schedule-choose">Choose a schedule below to create a new one that you can apply to your event types </p> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="{{route('availabilty.store')}}" method="post">
                                        @csrf
                                            <div class="appoinment-available" id="availability-section">
                                                <div class="appoinment-month" id="availability-section">
                                                    <ul>
                                                        <?php $currentDate = date('m');
                                                        $newDate = date('m',strtotime('+14 days',strtotime(date('Y-m-d'))));
                                                        if($currentDate == $newDate){?>
                                                            <li><a href="">{{date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))}}</a>
                                                            <input type="hidden" name="available_month" value="{{date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))}}" id="{{date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))}}"></li> 
                                                        <?php }else{?>
                                                            <li><a href="">{{date('M', mktime(0, 0, 0, $currentDate, 1, date('Y')))}}</a>
                                                            <input type="hidden" name="available_month" value="{{date('M', mktime(0, 0, 0, $currentDate, 1, date('Y')))}}" id="{{date('M', mktime(0, 0, 0, $currentDate, 1, date('Y')))}}"></li> 
                                                            <li><a href="">{{date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))}}</a>
                                                            <input type="hidden" name="available_month" value="{{date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))}}" id="{{date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))}}"></li> 
                                                        <?php }?> 
                                                    </ul>
                                                </div>
                                            
                                                <div class="appointment-date">
                                                    <ul>
                                                        <?php $begin = new DateTime( date('Y-m-d') );
                                                            $end   = new DateTime(date('Y-m-d',strtotime('+14 days',strtotime(date('Y-m-d')))));
                                                            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                                $date = $i->format("Y-m-d"); ?>
                                                                <li>
                                                                    <input type="checkbox" class="checkbox caldate" name="available_date[]" value="{{date('Y-m-d',strtotime($date))}}" id="{{date('d',strtotime($date))}}">
                                                                    <label class="option-item" for="{{date('d',strtotime($date))}}">
                                                                        <div class="option-inner-date">{{date('d',strtotime($date))}}</div>
                                                                        <div class="name">{{date('D',strtotime($date))}}</div>
                                                                    </label> 
                                                                </li> 
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                                

                                                <div class="appoinment-hours">
                                                    <table style="width:100%" class="table-time">
                                                        <tbody>  
                                                            <?php 
                                                            // date_default_timezone_set("Asia/Kolkata");
                                                                $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                foreach($range as $time){ 
                                                                    $hr = date("h:i A",$time);
                                                                    $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="time[]" value="{{date('H',$time).'_'.$hr}}" class="avail-regular"></td>
                                                                    <td> {{$hr .' - '.$OnehrDiff}}</td>
                                                                    <!-- <td>Available</td> -->
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <button class="login1 btn" type="submit" name="submit">Submit</button>
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
 