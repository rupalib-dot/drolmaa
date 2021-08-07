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
                                <h3 class="order-content">{{$title}}</h3> 
                                <form action="{{route('appointment.store')}}" method="POST" class="formLogIn">
                                    @csrf 
                                    <input type="hidden" value="{{Session::get('user_id')}}" name="user_id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Name" aria-label="Name"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <select class="form-control" id="exampleFormControlSelect1" name="plan" placeholder="Plan"
                                                    aria-label="Plan" aria-describedby="basic-addon2">
                                                    <option value="">Select Plan</option>
                                                    @foreach(config('constant.PLAN') as $value => $key)
                                                        <option {{ old('plan') == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <select onchange="expert_list(this.value)" class="form-control" id="exampleFormControlSelect1"
                                                    placeholder="Designation" name="designation" aria-label="Designation"
                                                    aria-describedby="basic-addon2">
                                                    <option value="">Designation</option>
                                                    @foreach($designation_list as $designation)
                                                        <option {{ old('designation') == $designation->designation_id ? 'selected' : ''}} value="{{$designation->designation_id}}">{{ucfirst(strtolower($designation->designation_title))}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="hidden" name="expert_id_hidden" id="expert_id_hidden" value="{{old('expert')}}">
                                                <select class="form-control expert_list" id="exampleFormControlSelect1"
                                                    placeholder="Expert" name="expert" aria-label="Expert"
                                                    aria-describedby="basic-addon2">
                                                    <option value="">Select Designation First</option> 
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="date" onchange="getDate(this.value)" min="{{date('Y-m-d')}}" class="form-control" value="{{old('date')}}" name="date" placeholder="Appointment Date"
                                                    aria-label="Date of Birth" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="hidden" name="time_hidden" id="time_hidden" value="{{old('time')}}">
                                                <select class="form-control time_list" id="exampleFormControlSelect1"
                                                    placeholder="Time" name="time" aria-label="Time"
                                                    aria-describedby="basic-addon2">
                                                    <option>Select Time Slot</option> 
                                                </select>
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
</section>
@include('include.footer') 
@include('include.script')
<script>
$(document).ready(function() {
    var date = $("input[name=date]").val(); 
    if(date != '')
    { 
        var time_hidden = $("input[name=time_hidden]").val(); 
        getDate(date,time_hidden);
    } 
    
    var designation_id = $("select[name=designation]").val();
    if(designation_id != '')
    {
        var expert_id_hidden = $("input[name=expert_id_hidden]").val();
        expert_list(designation_id, expert_id_hidden);
    } 
});
</script> 