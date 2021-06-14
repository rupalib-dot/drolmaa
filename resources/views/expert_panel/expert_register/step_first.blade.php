@include('include.header')
@include('include.nav')
<section id="clientMemberLogin" class="clientMemberLogin padding-top" role="Member log In">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back1">
                    @include('include.validation_message')
                    @include('include.auth_message')
                    <div class="clientTextF">
                        <h4 class="wel-heading">Welcome to</h4>
                        <h3>DrolMaa Constellation Club</h3>
                        <p class="clientP">Expert Register</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading">Personal Details</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-count">
                                <span class="count-back">2</span>
                            </div>
                            <p class="pro-heading">Professional Details</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-count">
                                <span class="count-back">3</span>

                            </div>
                            <p class="pro-heading">Documents</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-count">
                                <span class="count-back">4</span>
                            </div>
                            <p>Payment & Submit</p>
                        </div>

                    </div>
                    <form action="{{route('expert.first.step.post')}}" method="POST" enctype='multipart/form-data'
                        class="formLogIn">
                        @csrf
                        <div class="custom-file-container" data-upload-id="myUploader">
                            <label><a href="javascript:void(0)" class="custom-file-container__image-clear"
                                    title="Clear Image"></a></label>

                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                    accept="*" name="user_image">
                                <span class="custom-file-container__custom-file__custom-file-control pp"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Full Name" aria-label="Name"
                                        aria-describedby="basic-addon1" name="full_name"
                                        value="{{old('full_name', !empty($expert) ? $expert->full_name : '')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Mobile Number"
                                        aria-label="Phone" aria-describedby="basic-addon1" name="mobile_number"
                                        value="{{old('mobile_number', !empty($expert) ? $expert->mobile_number : '')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email Address"
                                        aria-label="Email" aria-describedby="basic-addon1" name="email_address"
                                        value="{{old('email_address', !empty($expert) ? $expert->email_address : '')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="number" placeholder="Age" class="form-control" name="user_age"
                                        value="{{old('user_age', !empty($expert) ? $expert->user_age : '')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <select class="form-control" id="exampleFormControlSelect1" name="user_gender">
                                        <option value="">Select Gender</option>
                                        @foreach(config('constant.GENDER') as $value => $key)
                                        <option
                                            {{ old('user_gender', !empty($expert) ? $expert->user_gender : '') == $key ? 'selected' : ''}}
                                            value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <select class="form-control" id="exampleFormControlSelect1"
                                        class="form-control country_id" name="country_id"
                                        onchange="state_list(this.value)">
                                        <option value="">Select Country</option>
                                        @foreach($country_list as $con_list)
                                        <option
                                            {{ old('country_id', !empty($expert) ? $expert->country_id : '') == $con_list->country_id ? 'selected' : ''}}
                                            value="{{$con_list->country_id}}">{{$con_list->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="hidden" name="state_id_hidden" id="state_id_hidden"
                                        value="{{old('state_id', !empty($expert) ? $expert->state_id : '')}}">
                                    <select class="form-control state_list" id="exampleFormControlSelect1"
                                        name="state_id" onchange="city_list(this.value)">
                                        <option value="">Select State</option>
                                        <option value="">rajasthan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="hidden" name="city_id_hidden" id="city_id_hidden"
                                        value="{{old('city_id', !empty($expert) ? $expert->city_id : '')}}">
                                    <select class="form-control city_list" id="exampleFormControlSelect1"
                                        class="form-control" name="city_id">
                                        <option value="">Select City</option>
                                        <option value="">jaipur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Address Detail"
                                        aria-label="Address" aria-describedby="basic-addon1" name="address_details"
                                        value="{{old('address_details',  !empty($expert) ? $expert->address_details : '')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                        aria-describedby="basic-addon1" name="user_password" value="{{old('user_password')}}">
                                   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                <input type="text" class="form-control" placeholder="Confirm password"
                                        aria-label="Confirm password" aria-describedby="basic-addon1" name="confirm_password" value="{{old('confirm_password')}}">
                                   
                                </div>
                            </div>
</div>
                            <div class="back-next">
                                <button type="submit" class="next">Next</button>
                            </div>
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
    if (country_id != '') {
        var state_id_hidden = $("input[name=state_id_hidden]").val();
        state_list(country_id, state_id_hidden);
    }

    if (state_id_hidden != '') {
        var city_id_hidden = $('#city_id_hidden').val();
        city_list(state_id_hidden, city_id_hidden);
    }
});
</script>