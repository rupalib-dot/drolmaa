<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/shopimg.png')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Checkout</h2>
            </div>
        </div>
    </div>
</section>
<section id="checkout" class="checkout">
    <div class="container">
    <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <form action="<?php echo e(route('placeOrder')); ?>" method="POST" class="formLogIn">
            <?php echo csrf_field(); ?>
            <div class="row"> 
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <?php $session = Session::get('order'); ?>
                    <div class="billing-detail">
                        <h3 class="billing-text mb-4">Billing details</h3> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <input type="text" class="form-control" placeholder="Full Name*" name="full_name" id="first name" value="<?php echo e(old('full_name',!empty($session) ? $session['full_name'] : '',!empty($user) ? $user['full_name'] : '')); ?>">
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <select class="form-control" id="exampleFormControlSelect1" name="user_gender">
                                            <option value="">Select Gender *</option>
                                            <?php $__currentLoopData = config('constant.GENDER'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old('user_gender',!empty($session) ? $session['user_gender'] : '',!empty($user) ? $user['user_gender'] : '') == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="text" class="form-control" placeholder="Company Name (optional)" aria-label="Name"
                                            aria-describedby="basic-addon1" name="company_name" value="<?php echo e(old('company_name',!empty($session) ? $session['company_name']:'')); ?>">
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="text" class="form-control" id="address" placeholder="House Number and street name *" aria-label="Address"
                                            aria-describedby="basic-addon1" name="address1" maxlength="250" value="<?php echo e(old('address1',!empty($session) ? $session['address1']:'',!empty($user) ? $user['address_details'] : '')); ?>">
                                        <input type="text" class="form-control" id="address" placeholder="Apartment, suite, unit, etc, (optional)" aria-label="Address"
                                            aria-describedby="basic-addon1" name="address2" maxlength="250"  value="<?php echo e(old('address2',!empty($session) ? $session['address2']:'')); ?>" style="margin-top:15px">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="form-control" class="form-control country_id" id="exampleFormControlSelect1" name="country_id" onchange="state_list(this.value)">
                                            <!-- <option value="">Select Country / Region *</option>
                                            <?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old('country_id',!empty($session) ? $session['country_id']:'',!empty($user) ? $user['country_id'] : '') == $con_list->country_id ? 'selected' : ''); ?> value="<?php echo e($con_list->country_id); ?>"><?php echo e($con_list->country_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                                            <option <?php echo e(old('country_id','101',!empty($session) ? $session['country_id']:'',!empty($user) ? $user['country_id'] : '') == 101 ? 'selected' : ''); ?> value="101">India<option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="hidden" name="state_id_hidden" id="state_id_hidden" value="<?php echo e(old('state_id',!empty($session) ? $session['state_id']:'',!empty($user) ? $user['state_id'] : '')); ?>">
                                        <select class="form-control state_list" id="exampleFormControlSelect1"
                                            name="state_id" onchange="city_list(this.value)">
                                            <option value="">Select State *</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="hidden" name="city_id_hidden" id="city_id_hidden" value="<?php echo e(old('city_id',!empty($session) ? $session['city_id']:'',!empty($user) ? $user['city_id'] : '')); ?>">
                                        <select class="form-control city_list" id="exampleFormControlSelect1"
                                            class="form-control" name="city_id">
                                            <option value="">Select Town / City *</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="text" class="form-control" placeholder="Pin Code *" aria-label="Pin code"
                                            aria-describedby="basic-addon1" id="pincode" name="pincode" value="<?php echo e(old('pincode',!empty($session) ? $session['pincode']:'')); ?>"> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-lg-2" style="padding-right:0px">
                                            <div class="form-group">
                                                <input type="text" class="form-control" aria-label="Country Code" aria-describedby="basic-addon1" name="country_code" value="+91" ReadOnly>
                                            </div> 
                                        </div>
                                        <div class="col-lg-10" style="padding-left:0px">  
                                            <div class="form-group"> 
                                                <input type="text" class="form-control" placeholder="Mobile Number *"
                                                    aria-label="Mobile Number" aria-describedby="basic-addon1" name="mobile_number" value="<?php echo e(old('mobile_number',!empty($session) ? $session['mobile_number']:'',!empty($user) ? $user['mobile_number'] : '')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="text" class="form-control" placeholder="Email Address *" aria-label="Email"
                                            aria-describedby="basic-addon1" name="email_address" value="<?php echo e(old('email_address',!empty($session) ? $session['email_address']:'',!empty($user) ? $user['email_address'] : '')); ?>">
                                    </div>
                                </div>
                                <!-- <div class="form-check list-regular ml-3">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedaccount"
                                        checked>
                                    <label class="form-check-label" for="flexCheckCheckedaccount">
                                        Create an account?
                                    </label>
                                </div> -->
                            </div> 
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <h3 class="billing-text mb-4">Your order</h3>
                    <div class="detail-cart h-fnt">
                        <div class="detail-cart">
                            <table class="table box-demo mb-0">
                                <thead class="text-black">
                                    <tr>
                                        <th scope="col">Price Details</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="mb-0">
                                            Total Price
                                        </td>
                                        <td class="text-red text-center"><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($totalcartamount,2,'.',',')); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="mb-0">
                                            Shipping
                                        </td>
                                        <td class="text-center">Free shipping</td>
                                    </tr>
                                    <!-- <tr>
                                        <td class="mb-0">
                                            Discount
                                        </td>
                                        <td class="text-red text-center">-₹150</td>
                                    </tr> -->
                                    <tr>
                                        <td class="mb-0">
                                            Total Amount
                                        </td>
                                        <td class="text-red text-center"><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($totalcartamount,2,'.',',')); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="update btn mt-3">Place order</button> 
                </div> 
            </div>
        </form>
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
</script>



 <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/orders/checkout.blade.php ENDPATH**/ ?>