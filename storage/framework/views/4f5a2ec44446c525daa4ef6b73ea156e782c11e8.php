<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style> 
.razorpay-payment-button{
    color: #fff;
    background-color: #d87611;
    border-color: #d87611;  
    font-weight: 400; 
    text-align: center;
    vertical-align: middle; 
    user-select: none; 
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem; 
}
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="col-md-12">
            <div class="back-appoint">
                <div class="row">
                    <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-md-10">
                        <div class="profile-form">
                            <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <h3 class="order-content">My Profile</h3>
                            <div style="border: 1px #952a16 solid; padding: 15px 15px 15px 15px; color: white; background: #952a16;">
                                <?php if(!empty($subscription_data)){?>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p> Subscriptions Plan Details </p>
                                        </div>
                                        <?php $olddate=strtotime($subscription_data->end_date); $curdate=strtotime(date('Y-m-d'));
                                            if($olddate < $curdate) {?>
                                                <div class="col-lg-6" style="display: flex;">
                                                    <form action="<?php echo e(route('expert.subscribe.post')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                            data-key="rzp_test_tazXyaYClLVzyb" data-amount="<?php echo e($subscription_data->register_amount); ?>00"
                                                            data-buttontext="Subscribe Plan" data-name="i4consulting.org"
                                                            data-description="Rozerpay"
                                                            data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                                            data-prefill.name="<?php echo e($record_data->full_name); ?>"
                                                            data-prefill.email="<?php echo e($record_data->email_address); ?>" data-theme.color="#ff7529">
                                                        </script>
                                                        <input type="hidden" value="<?php echo e($subscription_data->month .'_'.$subscription_data->plan_detail); ?>" id="month" name="month">
                                                        <input type="hidden" value="<?php echo e($record_data->user_id); ?>" id="user_id" name="user_id">
                                                    </form> 
                                                    <a style="margin-left: 10px;" href="<?php echo e(route('page.pricing',['update_plan'=>'update'])); ?>"><button style="background-color: #e80808;border-color: #e80808;" class="btn btn-info" type="button">Upgrade Plan</button></a>
                                                </div>
                                            <?php } ?>  
                                            <div class="col-lg-4">
                                                <button type="button" class="float-right btn btn-outline-danger  button_contact_page">Upgrade Plan</button>
                                            </div>
                                    </div>
                                    <div class="mt-3 row" <?php $olddate=strtotime($subscription_data->end_date); $curdate=strtotime(date('Y-m-d'));
                                        if($olddate < $curdate) {?> style="margin-top: 20px;" <?php } ?>>
                                        <div class="col-lg-6">
                                            <p> Plan Status:- 
                                                <?php $olddate=strtotime($subscription_data->end_date); $curdate=strtotime(date('Y-m-d'));  if($olddate < $curdate) { echo 'Expired Plan'; }else if($olddate >= $curdate) { echo 'Active Plan'; } ?>
                                            </p>
                                            <p>Amount:- <i class="fas fa-rupee-sign"></i> <?php echo e($subscription_data->register_amount); ?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="text-right">Time:- <?php echo e($subscription_data->month); ?> Month <?php echo e($subscription_data->plan_detail); ?></p>
                                            <p class="text-right">Date:- From  <?php echo e(date('d M,Y', strtotime($subscription_data->start_date))); ?>  To  <?php echo e(date('d M,Y', strtotime($subscription_data->end_date))); ?></p> 
                                        </div>
                                    </div> 
                                <?php } else{?>
                                    <a style="margin-left: 10px; margin-bottom:10px;" href="<?php echo e(route('page.pricing',['update_plan'=>'update'])); ?>"><button style="background-color: #e80808;border-color: #e80808;" class="btn btn-info" type="button">Upgrade Plan</button></a>
                                <?php } ?>
                            </div>
                        <form action="<?php echo e(url('expert/profile')); ?>/<?php echo e($record_data->user_id); ?>" class="formLogIn" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                    aria-describedby="basic-addon1" name="full_name" value="<?php echo e(old('full_name', $record_data->full_name)); ?>">
                                        
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                        aria-describedby="basic-addon1" name="email_address" value="<?php echo e(old('email_address', $record_data->email_address)); ?>">
                                        <button type="button" class="btn btn-danger verify_back input-group-text">Verify</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            placeholder="Gender" aria-label="Gender"
                                            aria-describedby="basic-addon2" name="user_gender">
                                            <option value="">Select Gender</option>
                                            <?php $__currentLoopData = config('constant.GENDER'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old('user_gender', $record_data->user_gender) == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <input type="date" class="form-control" placeholder="Date of Birth"
                                        aria-label="Date of Birth" aria-describedby="basic-addon1" name="user_dob" value="<?php echo e(old('user_dob', $record_data->user_dob)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-lg-3" style="padding-right:0px">
                                            <div class="input-group mb-4">
                                                <input type="text" class="form-control" aria-label="Country Code" aria-describedby="basic-addon1" name="country_code" value="+91" ReadOnly>
                                            </div> 
                                        </div>
                                        <div class="col-lg-9" style="padding-left:0px">  
                                            <div class="input-group mb-4">
                                                <input type="text" class="form-control" placeholder="Mobile Number"
                                                aria-label="Mobile Number" aria-describedby="basic-addon1" name="mobile_number" value="<?php echo e(old('mobile_number', $record_data->mobile_number)); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <select class="form-control" class="form-control country_id" id="exampleFormControlSelect1" name="country_id" onchange="state_list(this.value)">
                                            <!-- <option value="">Select Country</option>
                                            <?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old('country_id', $record_data->country_id) == $con_list->country_id ? 'selected' : ''); ?> value="<?php echo e($con_list->country_id); ?>"><?php echo e($con_list->country_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                                            <option <?php echo e(old('country_id', $record_data->country_id) == 101 ? 'selected' : ''); ?> value="101">India</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <input type="hidden" name="state_id_hidden" id="state_id_hidden" value="<?php echo e(old('state_id', $record_data->state_id)); ?>">
                                        <select class="form-control state_list" id="exampleFormControlSelect1"
                                            name="state_id" onchange="city_list(this.value)">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <input type="hidden" name="city_id_hidden" id="city_id_hidden" value="<?php echo e(old('city_id', $record_data->city_id)); ?>">
                                        <select class="form-control city_list" id="exampleFormControlSelect1"
                                            class="form-control" name="city_id">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <h3 style="color: #952A16;margin:25px 0px; ">Professional Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            placeholder="Designation" aria-label="Designation"
                                            aria-describedby="basic-addon2" name="designation_id">
                                            <option value="">Designation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control" placeholder="Phone" aria-label="Phone"
                                            aria-describedby="basic-addon1" name="office_phone_number" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-4">
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            placeholder="No of years of experience" aria-label="No of years of experience"
                                            aria-describedby="basic-addon2" name="user_experience">
                                            <option value="">No of years of experience</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Describe About Yourself..." id="exampleFormControlTextarea1" rows="4"></textarea>
                                </div>
                            <div class="special">
                                <h3>Specialization Plan</h3>
                                <p>Select only 2 Plan</p>
                                <div class="form-check list-regular">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked1" name="special_plan">
                                    <label class="form-check-label" for="flexCheckChecked1">
                                        Crisis intervention- immediate appointment and no diagnosis
                                    </label>
                                </div>
                                <div class="form-check list-regular">
                                    <input class="form-check-input" type="checkbox" value="2" id="flexCheckChecked2" name="special_plan">
                                    <label class="form-check-label" for="flexCheckChecked2">
                                        Deeper therapy route - consultation, screening and diagnosis and treatment ( a long term
                                        treatment).
                                    </label>
                                </div>
                                <div class="form-check list-regular">
                                    <input class="form-check-input" type="checkbox" value="3" id="flexCheckChecked3" name="special_plan">
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        Expression therapy route. Self enhancing & experiential mode.
                                    </label>
                                </div>
                                <div class="form-check list-regular">
                                    <input class="form-check-input" type="checkbox" value="4" id="flexCheckChecked4" name="special_plan">
                                    <label class="form-check-label" for="flexCheckChecked4">
                                        for general expertise guidance for issues like loneliness, relationships and so on
                                        where no diagnosis needed
                                        but yet professional help would make its difference.
                                    </label>
                                </div>
                                
                            <div class="back-next">
                                <button type="submit" class="next">Update Profile</button>
                                <a href="<?php echo e(url('expert/profile')); ?>/<?php echo e(Session::get('user_id')); ?>/edit"><button type="button" class="next" style="background-color: #aca4a2;">Cancel</button></a>
                            </div>
                             <!-- Button trigger modal -->
                             <button type="button" class="ml-3 mb-4 btn btn-info" data-toggle="modal" data-target="#exampleModal">Change Password</button>
                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 class="modal-title order-content" id="exampleModalLabel"><?php echo e($title); ?></h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <p class="fnt">Your new password must be different from previous used password.</p>
                                             <form action="<?php echo e(route('change-password-submit')); ?>" method="POST" class="formLogIn">
                                                 <?php echo csrf_field(); ?>                
                                                 <div class="row">
                                                     <div class="col-md-11 mb-5">
                                                         <div class="input-group mb-4">
                                                             <input type="password" maxlength="16" value="<?php echo e(old('CurrentPass')); ?>" name="CurrentPass"  id="login_password"  required class="form-control"
                                                                 placeholder="Old Password" aria-label="Name"
                                                                 aria-describedby="basic-addon1"> 
                                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('login_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                         </div>
                                                         <!-- <div class="col-md-4"></div> -->
                                                     </div>
                                                     <div class="col-md-11 mb-5">
                                                         <div class="input-group mb-4">
                                                             <input type="password" maxlength="16" name="NewPass" id="new_password" value="<?php echo e(old('NewPass')); ?>"  required class="form-control"
                                                                 placeholder="New Password" aria-label="Name"
                                                                 aria-describedby="basic-addon1">
                                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('new_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                         </div>
                                                         <!-- <div class="col-md-4"></div> -->
                                                     </div>
                                                     <div class="col-md-11">
                                                         <div class="input-group mb-4">
                                                             <input type="password" maxlength="16" name="ConfirmPass" id="confirm_password" value="<?php echo e(old('ConfirmPass')); ?>" required class="form-control"
                                                                 placeholder="Confirm Password" aria-label="Name"
                                                                 aria-describedby="basic-addon1">
                                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('confirm_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                         </div>
                                                         <!-- <div class="col-md-4"></div> -->
                                                     </div>
                                                     <div class="col-md-12">
                                                         <div class="input-group mb-4">
                                                             <button class="login1 btn" type="submit" name="submit">Submit</button>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div> 
                                     </div>
                                 </div>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
</script><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/expert_panel/profile.blade.php ENDPATH**/ ?>