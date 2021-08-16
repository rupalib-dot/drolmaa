<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<section id="clientLogIn" class="clientLogIn padding-top" role="Login" style="padding-top:120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="clientLogImage">
                    <div class="clientLogo">
                        <img src="<?php echo e(asset('front_end/images/bannerimg2.png')); ?>" alt="">
                        <h3 class="text-dark">DrolMaa Constellation Club</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="formRight">
                    <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="clientTextF">
                        <h4>Welcome to</h4>
                        <h3>DrolMaa Constellation Club</h3>
                        <p class="clientP">Forgot Password</p>
                    </div>
                    <form action="<?php echo e(route('forgot_password.submit')); ?>" class="formLogIn" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email Id"
                                        aria-label="Email Id" aria-describedby="basic-addon1" name="email_address" value="<?php echo e(old('email_address')); ?>">
                                </div> 
                            </div> 
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <button type="submit" name="submit" class="login1 btn">Reset Password</button>
                                </div> 
                            </div> 
                            
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/forgot-password.blade.php ENDPATH**/ ?>