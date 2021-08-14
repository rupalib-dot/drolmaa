<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
        <div class="container-fluid">
            <div class="row">
                <div class="header_workshop">
                    <div class="mt-3 mb-3 text-center">
                        <h3>Workshop Listing</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="pt-4 col-lg-4">
                    <div class=" filter_exper_list border border-2 w-100">
                        <div class=" px-3 pt-3">
                            <h3>Filter</h3>
                        </div>
                        <hr/>
                        <div class="p-3">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Search by Name" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="date" placeholder="Search by Date" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <!-- <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> -->
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="time" placeholder="Search by Time" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <!-- <span class="input-group-text"><i class="fas fa-search"></i></span> -->
                                </div>
                            </div>
                            <select class="mb-3 custom-select">
                                <option selected>Topic</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="custom-select">
                                <option selected>Search by Expert Name</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="my-4 filter_exper_list border border-2 w-100">
                        <div class=" px-3 pt-3">
                            <h3>Blogs</h3>
                        </div>
                        <hr/>
                        <div class="card border-0 mb-3" style="max-width:100%;">
                            <div class="row no-gutters p-2">
                                <div class="col-md-4">
                                    <img src="<?php echo e(asset('front_end/images/blog_workshop.svg')); ?>" class="rounded card-img" alt="...">
                                  
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2">
                                        <h6 style="font-weight:500;" class="card-title ">Consulting Counselling</h6>
                                        <p class="card-text text-muted ">Dr. Urmil Bishnoi is an expert Physical Therapist </p>    
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="card border-0 mb-3" style="max-width:100%;">
                            <div class="row no-gutters p-2">
                                <div class="col-md-4">
                                    <img src="<?php echo e(asset('front_end/images/blog_workshop1.svg')); ?>" class="rounded card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2">
                                        <h6 style="font-weight:500;" class="card-title ">Crisis intervention, Therapies</h6>
                                        <p class="card-text text-muted ">Dr. Urmil Bishnoi is an expert Physical Therapist </p>    
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="card border-0 mb-3" style="max-width:100%;">
                            <div class="row no-gutters p-2">
                                <div class="col-md-4">
                                    <img src="<?php echo e(asset('front_end/images/blog_workshop.svg')); ?>" class="rounded card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2">
                                        <h6 style="font-weight:500;" class="card-title ">Consulting Counselling</h6>
                                        <p class="card-text text-muted ">Dr. Urmil Bishnoi is an expert Physical Therapist </p>    
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="pt-4 col-lg-8">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a href="<?php echo e(route('live_webinar',['status'=>'live'])); ?>"> <button class="<?php if(!isset($request['status']) || $request['status'] == 'live'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Live Workshop</button></a>
                            <a href="<?php echo e(route('live_webinar',['status'=>'previous'])); ?>"> <button class="<?php if($request['status'] == 'previous'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Previous Workshop</button></a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="mt-4 tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?php if(count($Workshops)>0): ?>
                                <?php $__currentLoopData = $Workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workshop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card border-0 mb-3" style="max-width:100%;" data-city="workshop_1">
                                        <div class="row no-gutters">
                                            <div class="col-md-3">
                                                <img style="height: 270px;" src="<?php echo e(asset('workshop/'.$workshop->image)); ?>" class="card-img" alt="...">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body">
                                                    <h4 class="float-left card-title"><?php echo e($workshop->title); ?></h4>
                                                    <p class="text-right">Webinar</p>
                                                    <p class="text-muted"><?php echo e(CommonFunction::GetSingleField('users','full_name','user_id',$workshop->expert)); ?></p>
                                                    <div class="my-1 d-flex">
                                                        <img src="<?php echo e(asset('front_end/images/link_thumb.svg')); ?>" alt="">
                                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                                    </div>
                                                    <?php if(!empty($workshop->description)): ?>
                                                        <div class="mt-3">
                                                            <p class="text-muted font-weight-normal" style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px;" id="oldtext"><?php echo e($workshop->description); ?>

                                                            </p>
                                                            <p style="display:none" id="moretext"><?php echo e($workshop->description); ?>

                                                            </p>
                                                            <button class="btn btn-info btn-sm" onclick="myFunction('workshop_1')" id="myBtn">Read more</button>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="mt-3 mb-3 float-right expert_button">
                                                    <a href="<?php echo e(route('live_webinar_details',$workshop->workshop_id)); ?>">View Workshop</a>
                                                    <a href="<?php echo e(route('bookings.create')); ?>"class="px-4">Book Workshop</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="card border-0  mb-3" style="max-width:100%;">
                                    <div class="row no-gutters">
                                        <h3 style="margin: auto;"> No Record Found</h3>
                                    </div>
                                </div> 
                            <?php endif; ?>
                        </div>            
                    </div> 
                    <nav class="mb-4 mt-4" aria-label="Page navigation example"> 
                    <?php echo e($Workshops->appends($request->all())->render('vendor.pagination.custom')); ?> 
                    </nav>
                    
                    
                </div>
                
            </div>
        </div>     
        <script>
function myFunction(workshop) {
  var dots = document.querySelector(`.card[data-city="${workshop}"] #oldtext`);
  var more = document.querySelector(`.card[data-city="${workshop}"] #moretext`); 
  var moreText = document.querySelector(`.card[data-city="${workshop}"] #more`);
   var btnText = document.querySelector(`.card[data-city="${workshop}"] #myBtn`);
  

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
    </section>

<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/pages/live_webinar.blade.php ENDPATH**/ ?>