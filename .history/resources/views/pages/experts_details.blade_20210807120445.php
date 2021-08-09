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
                <div class="input-group">
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Enter City*" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Designation" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Speciality" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2 col-md-3">
                    <button type="button" class="w-100 btn btn-outline-danger">Search</button>
                     </div>
                </div>
           </div>
        </div>
    </div>
   </div>
   <div class="container">
   <div class="pt-4  col-lg-8">
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{asset('front_end/images/expert_profile.svg')}}" class="card-img" alt="...">
                                <!-- <div class="pl-0 col-lg-7 expert_button">
                                    <a href="/" target="_blank">View Profile</a>
                                    <a href="/" target="_blank">Book Appointment</a>
                                </div> -->
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. Urmil Bishnoi</h5>
                                    <p class="text-muted">Ph.D Psychology, M.Phil - Psychology</p>
                                    <p class="text-muted">7 Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                    </div>
                                    <div class="mt-3  about_expert">
                                    <p style="display:block" id="more">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae earum ullam
                                    </p>
                                    <p style="display:none" id="">
</p>

                                    <!-- <span style="display:none" id="more">
                                    <p>Dr. Urmil Bishnoi is an expert Physical Therapist with over 11 years experience providing direct patient care to individuals with physical disabilities and functional <span id="dots">...</span>

                                    <span style="display:none" id="more">
                                    Dr. Urmil Bishnoi is an expert Physical Therapist with over 11 years experience providing direct patient care to individuals with physical disabilities and functional l
                                    </span></p> -->
                                    <button onclick="myFunction()" id="myBtn">Read more</button>

                                    </div>
                                        <!-- <p class="text-muted mb-0">Availability ( Today)</p>
                                        <div class="pl-3 row">
                                        <div class="pl-0 col-lg-5 expert_time_slot">
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                        </div>

                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    </div>
</section>
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less";
    moreText.style.display = "inline";
  }
}
</script>

@include('include.footer')
@include('include.script')
@include('include.modal')
