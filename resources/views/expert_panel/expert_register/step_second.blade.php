@include('include.header')
@include('include.nav')
<section id="clientMemberLogin" class="clientMemberLogin padding-top" role="Member log In">
   
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back1">
                    @include('include.validation_message')
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
                            <p class="detail-heading width">Personal Details</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

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
                            <p>Payment & Submit
                            </p>
                        </div>
                    </div>
                    <form action="{{route('expert.second.step.post')}}" method="POST" enctype='multipart/form-data' class="formLogIn">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <select class="form-control" id="exampleFormControlSelect1"
                                        placeholder="Designation" aria-label="Designation"
                                        aria-describedby="basic-addon2" name="designation_id">
                                        <option value="">Designation</option>
                                        @foreach($designation_list as $desig_list)
                                            <option {{ old('designation_id', !empty($expert) ? $expert->designation_id : '') == $desig_list->designation_id ? 'selected' : ''}} value="{{$desig_list->designation_id}}">{{$desig_list->designation_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Phone" aria-label="Phone"
                                        aria-describedby="basic-addon1" name="office_phone_number" value="{{ old('office_phone_number', !empty($expert) ? $expert->office_phone_number : '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-4">
                                    <select class="form-control" id="exampleFormControlSelect1"
                                        placeholder="No of years of experience" aria-label="No of years of experience"
                                        aria-describedby="basic-addon2" name="user_experience">
                                        <option value="">No of years of experience</option>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @for($i==1;$i<=10;$i++)
                                            <option {{ old('user_experience', !empty($expert) ? $expert->user_experience : '') == $i ? 'selected' : ''}} value="{{$i}}">{{$i}} Year</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div> 
                        @php
                        
                            $special_plan =  old('special_plan', !empty($expert) ? explode(',',$expert->special_plan) : '');
                        @endphp
                        <div class="special">
                            <h3>Specialization Plan</h3>
                            <p>Select only 2 Plan</p>
                            <div class="form-check list-regular">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked1" name="special_plan[]" {{ !empty($special_plan)  && in_array(1, $special_plan) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked1">
                                    Crisis intervention- immediate appointment and no diagnosis
                                </label>
                            </div>
                            <div class="form-check list-regular">
                                <input class="form-check-input" type="checkbox" value="2" id="flexCheckChecked2" name="special_plan[]" {{ !empty($special_plan)  && in_array(2, $special_plan) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked2">
                                    Deeper therapy route - consultation, screening and diagnosis and treatment ( a long term
                                    treatment).
                                </label>
                            </div>
                            <div class="form-check list-regular">
                                <input class="form-check-input" type="checkbox" value="3" id="flexCheckChecked3" name="special_plan[]" {{ !empty($special_plan)  && in_array(3, $special_plan) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    Expression therapy route. Self enhancing & experiential mode.
                                </label>
                            </div>
                            <div class="form-check list-regular">
                                <input class="form-check-input" type="checkbox" value="4" id="flexCheckChecked4" name="special_plan[]" {{ !empty($special_plan)  && in_array(4, $special_plan) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked4">
                                    for general expertise guidance for issues like loneliness, relationships and so on
                                    where no diagnosis needed
                                    but yet professional help would make its difference.
                                </label>
                            </div>
                            <div class="back-next-next">
                            <a href="{{route('expert.first.step')}}" class="back">Back</a>
                            <button type="submit" class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')

