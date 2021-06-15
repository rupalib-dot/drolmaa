@include('include.header')
@include('include.nav')
<style>
.feather-eye
    {
        cursor: pointer;
        width: 16px;
        position: absolute;
        top: 6px;
        left: 225px;
    }
</style>
<section id="clientLogIn" class="clientLogIn padding-top" role="Login">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="clientLogImage" style="background-image:url({{asset('front_end/images/img1-1.png')}})">
                    <div class="clientLogo">
                        <img src="{{asset('front_end/images/bannerimg2.png')}}" alt="">
                        <h3>DrolMaa Constellation Club</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="formRight">
                    @include('include.validation_message')
                    @include('include.auth_message')
                    <div class="clientTextF">
                        <h4>Welcome to</h4>
                        <h3>DrolMaa Constellation Club</h3>
                        <div class="d-flex justify-content-between">
                            <p class="clientP">Client Register</p>
                            <p class="right">
                                Are you a Expert? <span class=regi-link><a href="{{url('expert_personal_details')}}" class="forgotPasswrd">Register Here</a></span>
                            </p>
                        </div>
                    </div>
                    <form action="{{route('customer.store')}}" class="formLogIn" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Full Name" aria-label="Name"
                                        aria-describedby="basic-addon1" name="full_name" value="{{old('full_name')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <select class="form-control" id="exampleFormControlSelect1" name="user_gender">
                                        <option value="">Select Gender</option>
                                        @foreach(config('constant.GENDER') as $value => $key)
                                            <option {{ old('user_gender') == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="date" class="form-control" placeholder="Date of Birth"
                                        aria-label="Date of Birth" aria-describedby="basic-addon1" name="user_dob" value="{{old('user_dob')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <select class="form-control" class="form-control country_id" id="exampleFormControlSelect1" name="country_id" onchange="state_list(this.value)">
                                        <option value="">Select Country</option>
                                        @foreach($country_list as $con_list)
                                            <option {{ old('country_id') == $con_list->country_id ? 'selected' : ''}} value="{{$con_list->country_id}}">{{$con_list->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="hidden" name="state_id_hidden" id="state_id_hidden" value="{{old('state_id')}}">
                                    <select class="form-control state_list" id="exampleFormControlSelect1"
                                        name="state_id" onchange="city_list(this.value)">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="hidden" name="city_id_hidden" id="city_id_hidden" value="{{old('city_id')}}">
                                    <select class="form-control city_list" id="exampleFormControlSelect1"
                                        class="form-control" name="city_id">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Mobile Number"
                                        aria-label="Mobile Number" aria-describedby="basic-addon1" name="mobile_number" value="{{old('mobile_number')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                        aria-describedby="basic-addon1" name="email_address" value="{{old('email_address')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                        aria-describedby="basic-addon1" name="user_password" id="user_password" value="{{old('user_password')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('user_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Confirm password"
                                        aria-label="Confirm password" aria-describedby="basic-addon1" id="confirm_password" name="confirm_password" value="{{old('confirm_password')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('confirm_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>

                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-check list-regular">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked4" name="nTerms">
                                <label class="form-check-label" for="flexCheckChecked4">
                                    I Accept terms and conditions &
                                    privacy policy
                                </label>
                            </div>
                            <p class="right">
                                By signing up, I agree to <span class=regi-link><a href="#" class="terms">terms
                                    </a></span>
                            </p>
                        </div>
                        <button class="login1 btn">Send OTP
                        </button>

                </div>
                </form>
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
<script>
        function ShowPass(id)
        {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>