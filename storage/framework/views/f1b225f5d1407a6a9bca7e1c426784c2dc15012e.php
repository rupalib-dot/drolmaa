<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
<div class="container-fluid">
    <div class="row">
        <div class="header_expert">
           <div class="mt-3 mb-3 text-center">
               <h3>Expert Profile</h3>
           </div>
           <div class="container mb-4">
              <form action="<?php echo e(route('our_experts')); ?>"class="form-appoint">
                  <div class="input-group">
                      <div class="my-2  col-md-3">
                          <input type="text" class="form-control" name="keyword" value="<?php echo e($request['keyword']); ?>" placeholder="Keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                      </div>
                      <div class="my-2  col-md-3">
                          <select class="form-control" id="exampleFormControlSelect1" placeholder="Designation" name="designation" aria-label="Designation" aria-describedby="basic-addon2">
                              <option value="">Designation</option>
                              <?php $__currentLoopData = $designation_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option <?php echo e(old('designation',$request['designation']) == $designation->designation_id ? 'selected' : ''); ?> value="<?php echo e($designation->designation_id); ?>"><?php echo e(ucfirst(strtolower($designation->designation_title))); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                      <div class="my-2  col-md-3">
                          <select class="form-control" id="exampleFormControlSelect1" placeholder="Specialization" name="specialization" aria-label="Specialization" aria-describedby="basic-addon2">
                              <option value="">Specialization</option>
                              <?php $__currentLoopData = $specialPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option <?php echo e(old('specialization',$request['specialization']) == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <img src="<?php echo e($infoPersonal['user_image']); ?>" height = 260px; class="card-img" alt="...">
                                <!-- <div class="pl-0 col-lg-7 expert_button">
                                    <a href="/" target="_blank">View Profile</a>
                                    <a href="/" target="_blank">Book Appointment</a>
                                </div> -->
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($infoPersonal['full_name']); ?></h5>
                                    <p class="text-muted"><?php echo e($infoPersonal['designation']); ?></p>
                                    <p class="text-muted"><?php echo e($infoPersonal['user_experience']); ?> Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="<?php echo e(asset('front_end/images/link_thumb.svg')); ?>" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold"><?php echo e($infoPersonal['rating']); ?></span> <?php if($infoPersonal['rating'] == 1): ?> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($infoPersonal['rating'] == 2): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($infoPersonal['rating'] == 3): ?> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> <?php elseif($infoPersonal['rating'] == 4): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <?php elseif($infoPersonal['rating'] == 5): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <?php else: ?> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php endif; ?></span>
                                    </div>
                                    <div class="mt-3  about_expert">
                                        <p  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; " id="oldtext"><?php echo e($infoPersonal['description']); ?>

                                        </p>
                                        <p style="display:none" id="moretext">
                                            <?php echo e($infoPersonal['description']); ?>

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
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="row">
                    <div class="col-lg-6">
                      <p>Address:- <?php echo e($infoPersonal['address_details']); ?></p>
                      <p> Mobile:-<?php echo e($infoPersonal['mobile_number']); ?></p>
                      <p>Email:- <?php echo e($infoPersonal['email_address']); ?></p>
                      <p>Age:- <?php echo e($infoPersonal['user_age']); ?></p>
                      <p>user DOB:- <?php echo e($infoPersonal['user_dob']); ?></p>
                      <p>Gender:- <?php echo e($infoPersonal['user_gender']); ?></p>
                    </div>
                    <div class="col-lg-6">
                      <p>Country:- <?php echo e($infoPersonal['country']); ?></p>
                      <p>State:- <?php echo e($infoPersonal['state']); ?></p>
                      <p>City:- <?php echo e($infoPersonal['city']); ?></p>
                      <p>Office Phone:- <?php echo e($infoPersonal['office_phone_number']); ?></p>
                      <p>Experience:- <?php echo e($infoPersonal['user_experience']); ?></p>  
                    </div>
                  </div>
                  <div class="row">
                      <label> Licance Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="<?php echo e($infoPersonal['licance_pic']); ?>" alt="">
                      <label> Pan Card Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="<?php echo e($infoPersonal['pan_card_pic']); ?>" alt="">
                      <label> Aadhar Card Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="<?php echo e($infoPersonal['aadhar_card_pic']); ?>" alt="">
                      <label> Professional Certificate Pic </label><img style="margin-right:20px;" width= 100px; height= 100px; src="<?php echo e($infoPersonal['professional_certificate_pic']); ?>" alt="">
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> 
                  <?php if(count($availSlots) >0): ?>
                  <div class="row">
                    <?php $__currentLoopData = $availSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slots): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                      <div class="col-lg-6"  style="border-bottom: 1px solid #0000001f; margin-bottom: 15px;padding-bottom:15px;">
                        <p class="text-muted mb-0"><?php if($slots['availability_id'] == date('Y-m-d')): ?> Today <?php elseif($slots['availability_id'] == date('Y-m-d', strtotime(date('Y-m-d'). ' +1 day'))): ?> Tommorrow <?php else: ?> <?php echo e($slots['date']); ?><?php endif; ?></p>
                        <p class="text-muted mb-0">Available Slots (<?php echo e($slots['available_slots']); ?>)</p>
                        <p class="text-muted mb-0">Booked Slots (<?php echo e($slots['booked_slots']); ?>)</p>
                        <div class="pl-3 row">
                            <div class="pl-0 col-lg-12 expert_time_slot">
                                <?php if(count($slots['time_slot'])>0): ?>
                                    <?php $__currentLoopData = $slots['time_slot']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><?php echo e($time); ?></p> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div> 
                        </div> 
                      </div> 
                      <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                     
                  <?php endif; ?>
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
                        <p> <?php echo e(CommonFunction::GetSingleField('users','full_name','user_id',$feedbacks->feedback_by)); ?></p>
                        <p style="margin-top: -40px;margin-left: 89%;"> <?php if($feedbacks['rating'] == 1): ?> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($feedbacks['rating'] == 2): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($feedbacks['rating'] == 3): ?> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> <?php elseif($feedbacks['rating'] == 4): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <?php elseif($feedbacks['rating'] == 5): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <?php else: ?> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php endif; ?></p>
                        <p> <?php echo e($feedbacks['message']); ?></p>  
                        <!-- <p> <?php echo e(array_search($feedbacks['module_type'],config('constant.FEEDBACK'))); ?> <?php if(!empty($module)): ?> (<?php echo e($module); ?>) <?php endif; ?></p> -->
                        <p style="margin-top: -40px;margin-left: 89%;"> <?php echo e(date('d M, Y',strtotime($feedbacks->created_at))); ?></p> 
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

<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/pages/experts_details.blade.php ENDPATH**/ ?>