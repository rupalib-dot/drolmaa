
<?php $__env->startSection('content'); ?> 
    <div class="container-fluid">
        <div class="row layout-top-spacing" id="cancel-row">
            <div id="ftFormArray" class="col-lg-12 layout-spacing">
                <?php echo $__env->make('admin.inc.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.inc.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4><?php echo e($title); ?></h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form class="text-left" method="POST" action="<?php echo e(route('settings.update',$settings->setting_id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?> 
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="mobile">Contact Name</label>
                                        <input maxlength="50" type="text" value="<?php echo e(old('contact_name', !empty($settings) ? $settings->contact_name : '')); ?>" required name="contact_name" class="form-control" id="contact_name" placeholder="Contact Name"> 
                                    </div>  
                                </div>
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="dob">Contact Email</label>
                                        <input  type="text" maxlength="50"  required name="contact_email" value="<?php echo e(old('contact_email', !empty($settings) ? $settings->contact_email : '')); ?>" class="form-control" id="contact_email" placeholder="Contact Email"> 
                                    </div> 
                                </div>
                            </div> 
                                
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="mobile">Contact Number</label>
                                        <input maxlength="10" type="text" value="<?php echo e(old('contact_no', !empty($settings) ? $settings->contact_no : '')); ?>" required name="contact_no" class="form-control" id="contact_no" placeholder="Contact Number">
                                    </div>  
                                </div>
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="dob">Other Contact Number</label>
                                        <input  type="text"  maxlength="10" required name="aleternate_no" value="<?php echo e(old('aleternate_no', !empty($settings) ? $settings->aleternate_no : '')); ?>" class="form-control" id="aleternate_no" placeholder="Other Contact Number">
                                    </div> 
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Contact Address</label>
                                        <textarea  maxlength="150" required name="contact_address" class="form-control" id="contact_address" placeholder="Contact Address"><?php echo e(old('contact_address', !empty($settings) ? $settings->contact_address : '')); ?></textarea> 
                                    </div>
                                </div> 
                            </div>  
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Privacy Policy</label>
                                        <textarea required name="privacy" class="form-control" id="privacy" placeholder="Privacy & Policy"><?php echo e(old('privacy', !empty($settings) ? $settings->privacy : '')); ?></textarea> 
                                    </div>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Terms & Condition</label>
                                        <textarea required name="terms_condition" class="form-control" id="terms_condition" placeholder="Terms & Condition"><?php echo e(old('terms_condition', !empty($settings) ? $settings->terms_condition : '')); ?></textarea> 
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name">About Us</label>
                                        <textarea required name="about_us" class="form-control" id="about_us" placeholder="About Us"><?php echo e(old('about_us', !empty($settings) ? $settings->about_us : '')); ?></textarea> 
                                    </div>
                                </div>  
                            </div>


                            
                            <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script> 
    CKEDITOR.replace( 'privacy' ); 
    CKEDITOR.replace( 'terms_condition' );  
    CKEDITOR.replace( 'about_us' );  
</script>
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/admin/settings.blade.php ENDPATH**/ ?>