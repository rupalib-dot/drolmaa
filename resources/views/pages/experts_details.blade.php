@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
<div class="container-fluid">
    <div class="row">
        <div class="header_expert">
           <div class="mt-3 mb-3 text-center">
               <h3>Expert Profile</h3>
           </div>
           <div class="container mb-4">
              <form action="{{route('our_experts')}}"class="form-appoint">
                  <div class="input-group">
                      <div class="my-2  col-md-3">
                          <input type="text" class="form-control" name="keyword" value="{{$request['keyword']}}" placeholder="Keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                      </div>
                      <div class="my-2  col-md-3">
                          <select class="form-control" id="exampleFormControlSelect1" placeholder="Designation" name="designation" aria-label="Designation" aria-describedby="basic-addon2">
                              <option value="">Designation</option>
                              @foreach($designation_list as $designation)
                                  <option {{ old('designation',$request['designation']) == $designation->designation_id ? 'selected' : ''}} value="{{$designation->designation_id}}">{{ucfirst(strtolower($designation->designation_title))}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="my-2  col-md-3">
                          <select class="form-control" id="exampleFormControlSelect1" placeholder="Specialization" name="specialization" aria-label="Specialization" aria-describedby="basic-addon2">
                              <option value="">Specialization</option>
                              @foreach($specialPlans as $value => $key)
                                  <option {{ old('specialization',$request['specialization']) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="my-2 col-md-3">
                      <button type="submit" class="w-100 btn btn-outline-danger">Search</button>    
                      </div>  
                  </div>
              </form>
           </div>
        </div>
    </div>
   </div>
            <div class="mb-5 container">
               <div class="row">
               <div class="pt-4  col-lg-8">
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{$infoPersonal['user_image']}}" height = 260px; class="card-img" alt="...">
                                <!-- <div class="pl-0 col-lg-7 expert_button">
                                    <a href="/" target="_blank">View Profile</a>
                                    <a href="/" target="_blank">Book Appointment</a>
                                </div> -->
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">{{$infoPersonal['full_name']}}</h5>
                                    <p class="text-muted">{{$infoPersonal['designation']}}</p>
                                    <p class="text-muted">{{$infoPersonal['user_experience']}} Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">{{$infoPersonal['rating']}}</span> @if($infoPersonal['rating'] == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($infoPersonal['rating'] == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($infoPersonal['rating'] == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($infoPersonal['rating'] == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($infoPersonal['rating'] == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</span>
                                    </div>
                                    <div class="mt-3  about_expert">
                                        <p  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; " id="oldtext">{{$infoPersonal['description']}}
                                        </p>
                                        <p style="display:none" id="moretext">
                                            {{$infoPersonal['description']}}
                                        </p>
                                        <button class="btn btn-info" onclick="myFunction()" id="myBtn">Read more</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4 col-lg-4">
                    <div class="expert_profile_slot">
                       
                    </div>
                </div>
               </div>
        <div class="mb-5 container">
                <nav>
                    <div class="nav bg-light nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Info</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Availability</a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Feedback</a>
                    </div>
                </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="row">
                    <div class="col-lg-6">
                      <p>Address:- {{$infoPersonal['address_details']}}</p>
                      <p> Mobile:-{{$infoPersonal['mobile_number']}}</p>
                      <p>Email:- {{$infoPersonal['email_address']}}</p>
                      <p>Age:- {{$infoPersonal['user_age']}}</p>
                      <p>user DOB:- {{$infoPersonal['user_dob']}}</p>
                      <p>Gender:- {{$infoPersonal['user_gender']}}</p>
                    </div>
                    <div class="col-lg-6">
                      <p>Country:- {{$infoPersonal['country']}}</p>
                      <p>State:- {{$infoPersonal['state']}}</p>
                      <p>City:- {{$infoPersonal['city']}}</p>
                      <p>Office Phone:- {{$infoPersonal['office_phone_number']}}</p>
                      <p>Experience:- {{$infoPersonal['user_experience']}}</p>  
                    </div>
                  </div>
                  <div class="row">
                      <label> Licance Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="{{$infoPersonal['licance_pic']}}" alt="">
                      <label> Pan Card Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="{{$infoPersonal['pan_card_pic']}}" alt="">
                      <label> Aadhar Card Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="{{$infoPersonal['aadhar_card_pic']}}" alt="">
                      <label> Professional Certificate Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="{{$infoPersonal['professional_certificate_pic']}}" alt="">
                  </div>
                </div> -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> 
                  @if(count($availSlots) >0)
                  <div class="row">
                    @foreach($availSlots as $slots)  
                      <div class="col-lg-6"  style="border-bottom: 1px solid #0000001f; margin-bottom: 15px;padding-bottom:15px;">
                        <p class="text-muted mb-0">@if($slots['availability_id'] == date('Y-m-d')) Today @elseif($slots['availability_id'] == date('Y-m-d', strtotime(date('Y-m-d'). ' +1 day'))) Tommorrow @else {{$slots['date']}}@endif</p>
                        <p class="text-muted mb-0">Available Slots ({{$slots['available_slots']}})</p>
                        <p class="text-muted mb-0">Booked Slots ({{$slots['booked_slots']}})</p>
                        <div class="pl-3 row">
                            <div class="pl-0 col-lg-12 expert_time_slot">
                                @if(count($slots['time_slot'])>0)
                                    @foreach($slots['time_slot'] as $time)
                                        <p>{{$time}}</p> 
                                    @endforeach
                                @endif
                            </div> 
                        </div> 
                      </div> 
                      <hr>
                    @endforeach
                    </div>
                     
                  @endif
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">  
                <?php if(count($feedback)){   
                   foreach($feedback as $feedbacks)   {
                    if($feedbacks->module_type == config('constant.FEEDBACK.APPOINMENT')){
                        $module = CommonFunction::GetSingleField('appointment','appoinment_no','appointment_id',$feedbacks->module_id);
                    }else if($feedbacks->module_type == config('constant.FEEDBACK.BOOKING')){
                        $module = CommonFunction::GetSingleField('bookings','booking_no','booking_id',$feedbacks->module_id);
                    }else if($feedbacks->module_type == config('constant.FEEDBACK.ORDER')){
                        $module = CommonFunction::GetSingleField('order','order_no','order_id',$feedbacks->module_id) ;
                    }else{
                        $module = "";
                    }
                    $byimage = CommonFunction::GetSingleField('users','user_image','user_id',$feedbacks->feedback_by); 
                    if(!empty($byimage)){
                      $image = asset('public/user_images/'.$byimage);
                    }else{
                      $image = asset('front_end/images/blogimg.jpg');
                    }?>
                      <div class="row" style="display: block;margin:0px">
                        <p> {{CommonFunction::GetSingleField('users','full_name','user_id',$feedbacks->feedback_by)}}</p>
                        <p style="margin-top: -40px;margin-left: 89%;"> @if($feedbacks['rating'] == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($feedbacks['rating'] == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($feedbacks['rating'] == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($feedbacks['rating'] == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($feedbacks['rating'] == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</p>
                        <p> {{$feedbacks['message']}}</p>  
                        <!-- <p> {{array_search($feedbacks['module_type'],config('constant.FEEDBACK'))}} @if(!empty($module)) ({{$module}}) @endif</p> -->
                        <p style="margin-top: -40px;margin-left: 89%;"> {{date('d M, Y',strtotime($feedbacks->created_at))}}</p> 
                      </div>
                      <hr>
                    <?php }   } ?>
                </div>
            </div>
        </div>
        <div class="faq_heading">
            <h3>Faq</h3>
        </div>
        <div class="accordion" id="accordionExample">
          <div class="card my-3">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button id="faq_button" class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  <i class="fas fa-plus float-right"></i>
                </button>
              </h2>
            </div>
            <div id="collapseOne"  class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="faq_answer card-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                deserunt mollit anim id est laborum.
              </div>
            </div>
          </div>
          <div class="card my-3">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  <i class="fas fa-plus float-right"></i>   
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="faq_answer card-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                deserunt mollit anim id est laborum.
              </div>
            </div>
          </div>
          <div class="card my-3">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  <i class="fas fa-plus float-right"></i>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="faq_answer card-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                deserunt mollit anim id est laborum.
              </div>
            </div>
          </div>
        </div>

</section>
<script>
function myFunction() {
  var dots = document.getElementById("oldtext");
  var more = document.getElementById("moretext");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "block") {
    dots.style.display = "none";
    more.style.display = "block";
    btnText.innerHTML = "Read less";
    moreText.style.display = "none";
  } 
  if(more.style.display === "none") {
    dots.style.display = "block";
    more.style.display = "block";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";
  }
  else{
    dots.style.display = "block";
    more.style.display = "none";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";  
  }
 
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        $('.card-header').click(function() {
            $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
        });
</script>

@include('include.footer')
@include('include.script')
@include('include.modal')
