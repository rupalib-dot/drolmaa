<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-md-10">
                            <div class="dashboard-panel" style="padding-top: 20px;">
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3> Add Workshop</h3>
                                <form action="<?php echo e(route('expworkshop.store')); ?>" method="POST" class="formLogIn" enctype='multipart/form-data'>
                                    <?php echo csrf_field(); ?> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" value="<?php echo e(old('title')); ?>" name="Title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" name="Expert_Name" id="Expert_name" value="<?php echo e(old('name')); ?>" placeholder="Expert Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" name="Select_Designation" id="Select_Designation" value="<?php echo e(old('name')); ?>" placeholder="Select Designation" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="time" name="time" id="time" value="<?php echo e(old('time')); ?>" placeholder="Time" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" name="Workshop_Duration" id="Workshop_Duration" value="<?php echo e(old('time')); ?>" placeholder="Workshop Duration" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="date" min="<?php echo e(date('Y-m-d')); ?>" class="form-control" value="<?php echo e(old('start_date')); ?>" name="start_date" placeholder="Workshop Start Date" aria-label="Date of Birth" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="date" min="<?php echo e(date('Y-m-d')); ?>" class="form-control" value="<?php echo e(old('date')); ?>" name="date" placeholder="Workshop End Date" aria-label="Date of Birth" aria-describedby="basic-addon1"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" class="form-control" value="" name="date" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" value="<?php echo e(old('image')); ?>" name="image" placeholder="Image" aria-label="Image" aria-describedby="basic-addon1"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text"  name="description" id="description" placeholder="Description" class="form-control"><?php echo e(old('description')); ?></textarea>
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <button class="login1 btn" type="submit" name="submit">Submit</button>
                                        </div>
                                </form>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/expert_panel/workshop/add.blade.php ENDPATH**/ ?>