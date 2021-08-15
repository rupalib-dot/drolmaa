<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
    <section id="banner" class="banner" role="banner" style="background-image:url(<?php echo e(asset('front_end/images/bannerimg1.png')); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bannerInner">
                        <img class="img-fluid" src="<?php echo e(asset('front_end/images/bannerimg2.png')); ?>">
                        <h3 class="customHeading">DrolMaa Constellation Club</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                        <!-- start botton -->
                            <!-- Button trigger modal -->
                        <a  class="sub btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                        Talk to Our Expert
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Get Your Coupan Code</h5>
                                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('contact-submit')); ?>" method="post" class="form-contact">
                                        <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e(config('constant.ENQUIERY.TALK TO EXPERT')); ?>" name="module_type">
                                     <input type="hidden" value="0" name="module_id">
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <input type="text" maxlength="30" class="form-control" value="<?php echo e(old('name')); ?>" placeholder="Name" name="name"  required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" value="<?php echo e(old('email')); ?>" name="email" placeholder="Email" aria-describedby="emailHelp" placeholder="Enter email"required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text"  maxlength="12" class="form-control" value="<?php echo e(old('phone')); ?>" placeholder="Phone" name="phone"  required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-control"  name="topic_id" id="topic_id">
                                                <option value="">Select Topic</option>
                                                <?php $__currentLoopData = config('constant.SPECIAL_PLANS'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(old('topic_id') == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>  
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="message" maxlength="250" id="exampleFormControlTextarea1" rows="3" required><?php echo e(old('message')); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                                </div>
                            </div>
                        </div>
                        <!-- end button -->
                        <!-- <a href="#"class="donate">Talk to Our Expert</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutUs" class="aboutUs" role="aboutus">
    <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="aboutText">
                        <img src="<?php echo e(asset('front_end/images/aboutimg2.png')); ?>" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="aboutPara">
                        <div class="seprate">
                            <p class="commonHeading">About</p>
                            <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                        </div>
                        <h2 class="allHeading1">A digital Platform that will help you maintain your mental health</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                        </p>
                        <a href="<?php echo e(route('page.about_us')); ?>" class="readMoreCta">Know More <i class="fas fa-chevron-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(Session::has('user_id') && Session::has('role_id')){
        if(Session::get('role_id') != 3){?>
            <section id="ourServices" class="ourServices" role="Services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="seprate">
                                <p class="commonHeading">Services</p>
                                <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                            </div>
                        </div> 
                        <div class="col-sm-9">
                            <div class="row">
                                <?php if(count($services) >0 ){
                                    foreach($services as $service){?>
                                        <?php if($service->services_title == 'Our Experts'): ?>
                                            <div class="col-sm-4"> 
                                                <div class="serviceBox" style="z-index:1;">
                                                    <a href="<?php echo e(route('our_experts')); ?>">
                                                        <div class="serviceImage">
                                                            <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <p><?php echo e($service->services_title); ?></p>
                                                    </a>
                                                </div> 
                                            </div> 
                                        <?php elseif($service->services_title == 'Our Training'): ?>
                                            <div class="col-sm-4"> 
                                                <div class="serviceBox" style="z-index:1;">
                                                    <a href="<?php echo e(route('our_training')); ?>">
                                                        <div class="serviceImage">
                                                            <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <p><?php echo e($service->services_title); ?></p>
                                                    </a>
                                                </div> 
                                            </div>  
                                        <?php elseif($service->services_title == 'Live Workshops'): ?>
                                            <div class="col-sm-4"> 
                                                <div class="serviceBox" style="z-index: 1;">
                                                    <a href="<?php echo e(route('live_webinar')); ?>">
                                                        <div class="serviceImage">
                                                            <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <p><?php echo e($service->services_title); ?></p>
                                                    </a>
                                                </div> 
                                            </div>  
                                        <?php elseif($service->services_title == 'Shops'): ?>
                                            <div class="col-sm-4"> 
                                                <div class="serviceBox" style="z-index: 1;">
                                                    <a href="<?php echo e(route('page.shop')); ?>">
                                                        <div class="serviceImage">
                                                            <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <p><?php echo e($service->services_title); ?></p>
                                                    </a>
                                                </div> 
                                            </div>  
                                        <?php elseif($service->services_title == 'Other Activities'): ?>
                                            <div class="col-sm-4"> 
                                                <div class="serviceBox" style="z-index: 1;">
                                                    <a href="<?php echo e(route('other_activities')); ?>">
                                                        <div class="serviceImage">
                                                            <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <p><?php echo e($service->services_title); ?></p>
                                                    </a>
                                                </div> 
                                            </div>  
                                        <?php endif; ?> 
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php }}else{ ?>
        <section id="ourServices" class="ourServices" role="Services">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="seprate">
                            <p class="commonHeading">Services</p>
                            <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                        </div>
                    </div> 
                    <div class="col-sm-9">
                        <div class="row">
                            <?php if(count($services) >0 ){
                                foreach($services as $service){?> 
                                    <?php if($service->services_title == 'Our Experts'): ?>
                                        <div class="col-sm-4"> 
                                            <div class="serviceBox" style="z-index: 2;">
                                                <a href="<?php echo e(route('our_experts')); ?>">
                                                    <div class="serviceImage">
                                                        <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                    </div>
                                                    <p><?php echo e($service->services_title); ?></p>
                                                </a>
                                            </div> 
                                        </div> 
                                    <?php elseif($service->services_title == 'Our Training'): ?>
                                        <div class="col-sm-4"> 
                                            <div class="serviceBox" style="z-index: 2;">
                                                <a href="<?php echo e(route('our_training')); ?>">
                                                    <div class="serviceImage">
                                                        <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                    </div>
                                                    <p><?php echo e($service->services_title); ?></p>
                                                </a>
                                            </div> 
                                        </div>  
                                    <?php elseif($service->services_title == 'Live Workshops'): ?>
                                        <div class="col-sm-4"> 
                                            <div class="serviceBox" style="z-index: 2;">
                                                <a href="<?php echo e(route('live_webinar')); ?>">
                                                    <div class="serviceImage">
                                                        <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                    </div>
                                                    <p><?php echo e($service->services_title); ?></p>
                                                </a>
                                            </div> 
                                        </div>  
                                    <?php elseif($service->services_title == 'Shops'): ?>
                                        <div class="col-sm-4"> 
                                            <div class="serviceBox" style="z-index: 2;">
                                                <a href="<?php echo e(route('page.shop')); ?>">
                                                    <div class="serviceImage">
                                                        <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                    </div>
                                                    <p><?php echo e($service->services_title); ?></p>
                                                </a>
                                            </div> 
                                        </div>  
                                    <?php elseif($service->services_title == 'Other Activities'): ?>
                                        <div class="col-sm-4"> 
                                            <div class="serviceBox" style="z-index: 2;">
                                                <a href="<?php echo e(route('other_activities')); ?>">
                                                    <div class="serviceImage">
                                                        <img style="border-radius: 100%;height: 60px; margin-top: -10px;" src="<?php echo e(asset('services/'.$service->services_photo)); ?>" class="img-fluid" alt="">
                                                    </div>
                                                    <p><?php echo e($service->services_title); ?></p>
                                                </a>
                                            </div> 
                                        </div>  
                                    <?php endif; ?> 
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }?>
    <!-- start featured products -->
    <section id="resources" class="resources" role="resources">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Featured Produts</p>
                        <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                    </div>
                </div>
                <!-- <div class="col-sm-12"> 
                    <a style="background-color: var(--yellow); height: 32px; padding: 5px 20px; border-radius: 3px; color: var(--white); font-size: 14px;" href="<?php echo e(route('page.shop')); ?>" class="float-right commonHeading">View All</a> 
                </div> -->
            </div>
            <div class="mt-5 gallery js-flickity"data-flickity-options='{ "wrapAround": true }'>
                <?php if(count($category) >0 ){
                foreach($category as $categorys){?> 
                <div class="col-sm-4">
                    <a class="text-dark" href="<?php echo e(route('page.shop',['category_id'=>$categorys->category_id])); ?>">
                    <div class="gallery-cell">
                        <div class="card border-0" style="width:18rem;">
                            <img src="<?php echo e(asset('storage/category/'.$categorys->category_image)); ?>"  width="232px" height="223px" class="card-img-top" alt="...">
                            <div class="text-center card-body">
                                <h5 class="card-title"><?php echo e($categorys->category_name); ?></h5> 
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                <?php }} ?>
            </div>
            <div class="mt-5 text-center"> 
                <a style="background-color: var(--yellow); height: 32px; padding: 5px 20px; border-radius: 3px; color: var(--white); font-size: 14px;" href="<?php echo e(route('page.shop')); ?>" class=" commonHeading">View All</a> 
            </div>
        </div>
                                    
        
        
     <!--    <div class="container mcontainer">
	            <div class="owl-carousel testimonials-carousel">
	                
	                <div class="testimonial-item p-0 minhauto">
	                    <a href="#">
	                        <img src="http://localhost/BKP_27_07/drolamaa.i4dev.in/front_end/images/bannerimg1.png" class="w-100 h200 himagesize"
	                            alt="">
	                        <h3 class="text-left pl-3">bb}</h3>
	                    </a>
	                    <p class="text-justify px-3 mb-1  homecontentbox53char line-clamp">12345</p>
	                    <p class="text-left pl-3 m-0 mb-2">
	                        <span class="serv-rating">
	                            <div class="rate pl-3">
	                                <input type="radio"
	                                    <?php echo e((!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng == 5) ? 'checked' : ''); ?>>
	                                <label for="star5"></label>
	                                <input type="radio"
	                                    <?php echo e((!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 5 && $oGetRtng[0]->nAvrgRtng >= 4) ? 'checked' : ''); ?>>
	                                <label for="star4"></label>
	                                <input type="radio"
	                                    <?php echo e((!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 4 && $oGetRtng[0]->nAvrgRtng >= 3) ? 'checked' : ''); ?>>
	                                <label for="star3"></label>
	                                <input type="radio"
	                                    <?php echo e((!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 3 && $oGetRtng[0]->nAvrgRtng > 2) ? 'checked' : ''); ?>>
	                                <label for="star2"></label>
	                                <input type="radio"
	                                    <?php echo e((!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 2 && $oGetRtng[0]->nAvrgRtng >= 1) ? 'checked' : ''); ?>>
	                                <label for="star1"></label>
	                        </span>
	                </div>
	                </span>
	                <span style="font-size: 13px; margin-top: 3px;">fbfbbf</span>
	                </p>
	                <div class="text-center py-2 pt-3 px-0">
	                    <a href="#"
	                        class="btn-primary btn mb-2">Know More</a>
	                </div>
	            </div>
	
	        </div>

	        </div>




                   <div class="mt-4"> 
                    <a href="<?php echo e(route('page.shop')); ?>" class=""><button class="sub">See All</button></a>
                                    </div>--> 
                
    </section> 
    <!-- end featured products -->
    <section id="resources" class="resources" role="resources">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Resources</p>
                        <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                    </div>
                    <h2 class="allHeading1">A digital Platform that will help you<br> maintain your mental health
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br> incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="bookImage">
                        <img src="<?php echo e(asset('front_end/images/bookimg1.png')); ?>" alt="" class="img-fluid mb-4 imgOne">   
                        <a href="#"><button class="sub">Subscribe Now</button></a>  
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="resourceText">
                        <img src="<?php echo e(asset('front_end/images/resourceimg.png')); ?>" alt="" class="img-fluid mb-4">
                        <div class="resourcechannel">
                        <a href="#"><button class="sub">Subscribe Now</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mobileApp" class="mobileApp" role="mobileApp">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Mobile App</p>
                        <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mobileAppText">
                                <h2 class="allHeading1">Monitor your mental health and became happie
                                </h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore </p>
                                <a href="#" class="playcta"><img src="<?php echo e(asset('front_end/images/iosimg.svg')); ?>" alt=""></a>
                                <a href="#" class="playcta"><img src="<?php echo e(asset('front_end/images/gplayimg.svg')); ?>" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mobileAppImage">
                                <img src="<?php echo e(asset('front_end/images/mobileImage.png')); ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
    </section>
    <section id="testimonial" class="testimonial" role="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Testimonials</p>
                        <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                    </div>
                    <h2 class="allHeading1">What Our Clients Say
                    </h2>
                    <div class="row">
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">    
                                <?php if(count($testimonial)>0): ?>
                                    <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="swiper-slide col-md-6">
                                            <div class="testimonialBox" style="background-image:url(<?php echo e(asset('front_end/images/quote.png')); ?>)">
                                                <p><?php echo e($testi->testimonial_detail); ?>

                                                </p>
                                                <div class="testimonialImage" style="height: 30px; background-image:url(<?php echo e(asset('public/testimonial/'.$testi->person_photo)); ?>)"> </div>
                                                <h5><?php echo e($testi->person_name); ?></h5>
                                            </div>
                                        </div> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog" class="blog" role="blog">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Our Blog</p>
                        <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                    </div>
                    <h2 class="allHeading1">Mind Blogging
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut<br>
                        labore et dolore magna aliqua. Lorem ipsum dolor sit amet,
                    </p>
                    <div class="row">
                        <?php if(count($blogcategory) >0 ){
                            foreach($blogcategory as $categorys){?> 
                                <div class="col-md-4">
                                    <a href="<?php echo e(route('page.bloglist',$categorys->category_id)); ?>">
                                        <div class="blogImage">
                                            <div class="blogBox" style="background-image:url(<?php echo e(asset('storage/category/'.$categorys->category_image)); ?>);">
                                            </div>
                                            <div class="blogText"> 
                                            <h5 class="mb-0"><?php echo e($categorys->category_name); ?></h5>
                                            </div>
                                        </div> 
                                    </a>
                                </div>
                        <?php } } ?>
                    </div> 
                    <div class="text-center">
                        <a href="<?php echo e(route('page.blog')); ?>"><button class="sub">View All Categories</button></a>
                        </div>

                </div>
            </div>
        </div>
    </section>
    <section id="contact_form_home" class="testimonial"> 
        <div class="container">
        <div class="row">
        <div class="col-md-4 col-lg-5  pt-3 d-flex align-items-end justify-content-start">
            <img src="<?php echo e(asset('front_end/images/contact_back.png')); ?>" alt="" sizes="" srcset="">
        </div>
                <div class="col-md-8 col-lg-7">
                    <div class="seprate">
                        <p class="commonHeading">Contact Us</p>
                        <span class="cimg"><img src="<?php echo e(asset('front_end/images/cimg.png')); ?>" alt=""></span>
                    </div>
                    Let's talk!
        <form action="<?php echo e(route('contact-submit')); ?>" method="post" class="form-contact home_contact">
        <?php echo csrf_field(); ?>
        <input type="hidden" value="<?php echo e(config('constant.ENQUIERY.CONTACT')); ?>" name="module_type">
        <input type="hidden" value="0" name="module_id">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-2">
                    
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name')); ?>" placeholder="Name" name="name" aria-label="Name"
                        aria-describedby="basic-addon1" <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> autofocus <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>   
                </div>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-2">
                    <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('phone')); ?>" name="phone" placeholder="Phone" aria-label="Phone"
                        aria-describedby="basic-addon1" <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> autofocus <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>  
                </div>
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-2">
                    <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" name="email" placeholder="Email" aria-label="Email"
                        aria-describedby="basic-addon1" <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> autofocus <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                     
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-sm-12">
                <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" id="exampleFormControlTextarea1" rows="3"
                    placeholder="Message" <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> autofocus <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>><?php echo e(old('message')); ?></textarea>
                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button name="submit" class="submit-contact">Submit</button>
</form>
        </div>
        
        </div>
        
</div>
</section>
<section id="channel" class=" mt-5 channel" role="channel">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="channelbox">
                        <h4>G. Meyer Books & Spiritual Traveler Press</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="channelbox">
                        <p>Sale Up To</p>
                        <h2><a href="#" class="offer">30% OFF</a></h2>
                    </div>
                </div>
                <div class="col-md-4 align-self-center text-center">
                    <div class="">
                        <!-- Button trigger modal -->
                        <button type="button" class="sub btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Click to see Coupon Code</button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Get Coupan Code</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" placeholder="E-Mail" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" placeholder="Mobile Number" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
        
    </script>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
  <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/welcome.blade.php ENDPATH**/ ?>