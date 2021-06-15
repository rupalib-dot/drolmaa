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
                                <h3>Set your availability</h3>
                                <p class="schedule-choose">Choose a schedule below to edit or create a new one that you
                                    can
                                    apply to your event types
                                </p> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="appoinment-available" id="availability-section">
                                            <div class="appoinment-month" id="availability-section">
                                                <ul>
                                                    <?php for ($m = date('m'); $m <= 12; $m++){  ?>
                                                        <li><a href="#">{{date('M', mktime(0, 0, 0, $m, 1, date('Y')))}}</a>
                                                        <input type="hidden" name="available_month[]" value="{{date('M', mktime(0, 0, 0, $m, 1, date('Y')))}}" id="{{date('M', mktime(0, 0, 0, $m, 1, date('Y')))}}"></li>
                                                    <?php }?> 
                                                </ul>
                                            </div>
                                           
                                            <div class="appointment-date">
                                                <ul>
                                                    <?php for($d = 1; $d <=  date('t'); $d++){
                                                        $date = date('Y') . "-" . date('m') . "-" . str_pad($d, 2, '0', STR_PAD_LEFT);?>
                                                        <li>
                                                            <input type="checkbox" class="checkbox caldate" name="available_date[]" value="{{date('d',strtotime($date))}}" id="{{date('d',strtotime($date))}}">
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
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>9.00am - 10.00am</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>10.00am - 11.00am</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>11.00am - 12.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>12.00pm - 1.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>1.00pm - 2.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>2.00pm - 3.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>3.00pm - 4.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>4.00pm - 5.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>5.00pm - 6.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>6.00pm - 7.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>7.00pm - 8.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>7.00pm - 8.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>8.00pm - 9.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>9.00pm - 10.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" class="avail-regular"></td>
                                                            <td>10.00pm - 11.00pm</td>
                                                            <td>Available</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <button class="login1 btn" type="submit" name="submit">Submit</button>
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
 