<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments"> 
   <div class="container-fluid">
    <div class="row">
        <div class="header_expert">
           <div class="mt-3 mb-3 text-center">
               <h3>Expert Listing</h3>
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
   <div class="container">
       <div class="row">
           <div class="pt-4 col-lg-4">
               <div class=" filter_exper_list border border-2 w-100">
                    <div class="text-muted px-3 pt-3">
                        <h3>Filter</h3>
                    </div>
                    <hr/>
                    <div class="p-3">
                        <h6>SPECIALIZATION</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <hr/>
                        <h6>LOCALITY</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >lorem ipsum</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >lorem ipsum</span>
                        </div>
                        <hr/>
                        <h6>AVAILABILITY</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Today</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Tomorrow</span>
                            <!-- <span class="ml-5">Add</span> -->
                        </div>
                        <hr/>
                        <h6>CLINIC FEES</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <hr/>
                        <h6>GENDER</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Male</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Female</span>
                        </div>
                        <hr/>
                    </div>
                </div>
           </div>
                <div class="pt-4  col-lg-8">
                    <?php if(count($experts)>0): ?>
                        <?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $feedback_count   = DB::table('feedback')->where('feedback_to',$expert->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->count();
                            $feedback_data    = DB::table('feedback')->where('feedback_to',$expert->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->sum('rating');
                            $rating = 0;
                            if($feedback_count >0 && $feedback_data >0){
                                $rating = round(($feedback_data/$feedback_count));       
                            }
                            //availability data
                            $availSlots=array();
                            $avail_slots = DB::table('availability')->where('user_id',$expert->user_id)->get();
                            if(count($avail_slots) >0){
                                $availSlots =  CommonFunction::getslotsData($expert->user_id);
                            }?>
                                <div class="card border-0  mb-3" style="max-width:100%;">
                                    <div class="row no-gutters">
                                        <div class="col-md-3">
                                        <img width="100%;" height="130px;" src="<?php echo e(asset('public/user_images/'.$expert->user_image)); ?>" class="card-img" alt="...">
                                            <div class="pl-0 expert_button">
                                                <a style="min-width: 100%; text-align:center" href="<?php echo e(route('expert.details',$expert->user_id)); ?>" target="_blank">View Profile</a> 
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo e($expert->full_name); ?></h5>
                                                <p class="text-muted"><?php echo e(CommonFunction::GetSingleField('designation','designation_title','designation_id',$expert->designation_id)); ?></p>
                                                <p class="text-muted"><?php echo e($expert->user_experience); ?> Years Experience Overall</p>
                                                <div class="my-1 d-flex">
                                                    <img src="<?php echo e(asset('front_end/images/link_thumb.svg')); ?>" alt="">
                                                    <span class="align-self-center"><span class="ml-2 text-success font-weight-bold"><?php echo e($expert->$rating); ?></span> <?php if($rating == 1): ?> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($rating == 2): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($rating == 3): ?> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> <?php elseif($rating == 4): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <?php elseif($rating == 5): ?> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <?php else: ?> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php endif; ?></span>
                                                </div>
                                                <?php if(count($availSlots) >0): ?>
                                                    <?php $__currentLoopData = $availSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slots): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($slots['availability_id'] == date('Y-m-d')): ?>
                                                            <?php if($slots['available_slots'] >0): ?>
                                                                <p class="text-muted mb-0"><?php echo e($slots['available_slots']); ?> Available Slots (<?php echo e($slots['date']); ?>)</p>
                                                                <!-- <p class="text-muted mb-0">Available Slots (<?php echo e($slots['available_slots']); ?>)</p> -->
                                                                <!-- <p class="text-muted mb-0">Booked Slots (<?php echo e($slots['booked_slots']); ?>)</p> -->
                                                                <div class="pl-3 row">
                                                                    <div class="pl-0 col-lg-12 expert_time_slot">
                                                                        <?php if(count($slots['time_slot'])>0): ?>
                                                                            <?php $__currentLoopData = $slots['time_slot']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <p><?php echo e($time); ?></p> 
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </div> 
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <div class="pl-0 col-lg-12 expert_button">
                                                    <a style="display:none; text-align:center" href="" target="_blank"></a>
                                                    <a style="text-align:center; margin-left: 60%;" href="<?php echo e(route('appointment.create')); ?>" target="_blank">Book Appointment</a>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                        <div class="card border-0  mb-3" style="max-width:100%;">
                            <div class="row no-gutters">
                                <h3 style="margin: auto;"> No Record Found</h3>
                            </div>
                        </div> 
                    <?php endif; ?>
                     
                    <nav class="mb-4 mt-4" aria-label="Page navigation example">
                    <?php echo e($experts->appends($request->all())->render('vendor.pagination.custom')); ?> 
                        <!-- <ul class="pagination justify-content-start">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="active   page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul> -->
                    </nav>
                </div>
                
       </div>
   </div>
 
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/pages/experts.blade.php ENDPATH**/ ?>