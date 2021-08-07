@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.client_sidebar')
                        <div class="col-md-9">
                            <div class="profile-form">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">My Profile</h3>
                            <form action="{{route('profile.update',$record_data->user_id)}}" class="formLogIn" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                        aria-describedby="basic-addon1" name="full_name" value="{{old('full_name', $record_data->full_name)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                            aria-describedby="basic-addon1" name="email_address" value="{{ old('email_address', $record_data->email_address) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                placeholder="Gender" aria-label="Gender"
                                                aria-describedby="basic-addon2" name="user_gender">
                                                <option value="">Select Gender</option>
                                                @foreach(config('constant.GENDER') as $value => $key)
                                                    <option {{ old('user_gender', $record_data->user_gender) == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="date" class="form-control" placeholder="Date of Birth"
                                            aria-label="Date of Birth" aria-describedby="basic-addon1" name="user_dob" value="{{old('user_dob', $record_data->user_dob)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-lg-2" style="padding-right:0px">
                                                <div class="input-group mb-4">
                                                    <input type="text" class="form-control" aria-label="Country Code" aria-describedby="basic-addon1" name="country_code" value="+91" ReadOnly>
                                                </div> 
                                            </div>
                                            <div class="col-lg-10" style="padding-left:0px"> 
                                                <div class="input-group mb-4">
                                                    <input type="text" class="form-control" placeholder="Mobile Number"
                                                        aria-label="Mobile Number" aria-describedby="basic-addon1" name="mobile_number" value="{{old('mobile_number', $record_data->mobile_number)}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <select class="form-control" class="form-control country_id" id="exampleFormControlSelect1" name="country_id" onchange="state_list(this.value)">
                                                <option value="">Select Country</option>
                                                <!-- @foreach($country_list as $con_list)
                                                    <option {{ old('country_id', $record_data->country_id) == $con_list->country_id ? 'selected' : ''}} value="{{$con_list->country_id}}">{{$con_list->country_name}}</option>
                                                @endforeach -->
                                                <option {{ old('country_id', '101',$record_data->country_id) == 101 ? 'selected' : ''}} value="101">India</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="hidden" name="state_id_hidden" id="state_id_hidden" value="{{old('state_id', $record_data->state_id)}}">
                                            <select class="form-control state_list" id="exampleFormControlSelect1"
                                                name="state_id" onchange="city_list(this.value)">
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="hidden" name="city_id_hidden" id="city_id_hidden" value="{{old('city_id', $record_data->city_id)}}">
                                            <select class="form-control city_list" id="exampleFormControlSelect1"
                                                class="form-control" name="city_id">
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="back-next">
                                        <button type="submit" class="next mr-2">Update Profile</button>
                                        <a href="{{url('profile')}}/{{Session::get('user_id')}}/edit"><button type="button" class="next" style="background-color: #aca4a2;">Cancel</button></a>
                                    </div>
</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
  Change Password
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title order-content text-light" id="exampleModalLabel">{{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <!-- <h3 class="order-content">{{$title}}</h3> -->
                                <p class="fnt">Your new password must be different from previous used password.</p>
                                <form action="{{route('change-password-submit')}}" method="POST" class="formLogIn">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-11 mb-5">
                                            <div class="input-group mb-4">
                                                <input type="password" maxlength="16" value="{{old('CurrentPass')}}" name="CurrentPass"  id="login_password"  required class="form-control"
                                                    placeholder="Old Password" aria-label="Name"
                                                    aria-describedby="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('login_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <div class="col-md-11 mb-5">
                                            <div class="input-group mb-4">
                                                <input type="password" maxlength="16" name="NewPass" id="new_password" value="{{old('NewPass')}}"  required class="form-control"
                                                    placeholder="New Password" aria-label="Name"
                                                    aria-describedby="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('new_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="input-group mb-4">
                                                <input type="password" maxlength="16" name="ConfirmPass" id="confirm_password" value="{{old('ConfirmPass')}}" required class="form-control"
                                                    placeholder="Confirm Password" aria-label="Name"
                                                    aria-describedby="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('confirm_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-4">
                                                <button class="login1 btn" type="submit" name="submit">Submit</button>
                                            </div>
                                        </div>

                                </form>
                            </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
                                    </div>
                                    </div>
                            </form>
                  
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
    var country_id = $("select[name=country_id]").val();
    if(country_id != '')
    {
        var state_id_hidden = $("input[name=state_id_hidden]").val();
        state_list(country_id, state_id_hidden);
    }

    if(state_id_hidden != '')
    {
        var city_id_hidden = $('#city_id_hidden').val();
        city_list(state_id_hidden, city_id_hidden);
    }
});
</script>