@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
        <div class="row">
            <div class=" mb-3 pt-4 col-lg-4 workshop_default_profile">
                <img src="{{asset('front_end/images/workshop_profile.svg')}}" class="pb-5 pr-5 border-top-0  card-img" alt="...">
                <!-- Button trigger modal -->
                <button type="button" class="enquire_btn text-center btn btn-danger" data-toggle="modal" data-target="#exampleModal">Enquire Now</button>
                    <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-light" id="exampleModalLabel">Expert Enquire</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name_user">Name</label>
                                            <input type="text" class="form-control" id="name_user" placeholder="Your Name" required>
                                        </div>
                                        <label for="email1">Email address</label>
                                        <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email"required>
                                        <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Message</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="pl-0 book_work_button">
                    <a href="#" type="button" class="btn btn-outline-danger">Book Workshop</a>
                </div>
            </div>
            <div class="pt-4 col-lg-8">
                <div class="card border-0 mb-3" style="max-width:100%;">
                    <div class="row no-gutters">
                        <div class="col-md-3">
                        <img src="{{asset('front_end/images/workshop_expert_images.svg')}}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Expert Name</h5>
                                <p class="text-muted mb-1">Designation</p>
                                <p class="card-text text-muted mb-1">7 Years Experience Overall</p>
                                <img src="{{asset('front_end/images/star.png')}}" alt="..."> 
                                <div class="mt-3  about_expert">
                                    <p  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; " id="oldtext">
                                        Dr. Urmil Bishnoi is an expert Physical Therapist with over 11 years experience
                                    </p>
                                    <p style="display:none" id="moretext">
                                        Dr. Urmil Bishnoi is an expert Physical Therapist with over 11 years experience providing direct patient care to individuals with physical disabilities and functional
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae earum
                                    </p>
                                    <button class="btn btn-info" onclick="myFunction()" id="myBtn">Read more</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-5" style="width:100%;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Date</span>
                                </div>
                                <p class="card-text"><small class="text-muted">Workshop/Seminar Date</small></p>
                                <div class="heading">
                                    <p>To:-<span>12 june 2021</span></p>
                                    <p>From:-<span>12 june 2021</span></p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="card-title">
                                        <i class="far fa-clock"></i>
                                        <span>Time</span>
                                    </div>
                                    <p class="card-text"><small class="text-muted">Workshop/Seminar Time</small></p>
                                    <div class="heading">
                                        <p>10:30 AM</p>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-title">
                                        <i class="far fa-clock"></i>
                                        <span>Duration</span>
                                </div>
                                <p class="card-text"><small class="text-muted">Workshop/Seminar Duration</small></p>
                                <div class="heading">
                                        <p>2.00 Hr</p>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div  class="col-lg-4">
                                <div class="card-title">
                                <i class="fas fa-dollar-sign"></i>
                                    <span>Amount</span>
                                </div>
                                <p class="card-text"><small class="text-muted">Workshop/Seminar Time</small></p>
                                <!-- <div class="heading">
                                    <p>10:30 AM</p>
                                </div> -->
                            </div>
                            <div  style="align-self: center;"class="col-lg-2">
                                <div class="heading">
                                    <p> $500.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
 