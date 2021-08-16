

<?php $__env->startSection('content'); ?>
<style>
i{
    color:red;
}
</style>
    <div class="container-fluid">
        <div class="row layout-top-spacing" id="cancel-row">
            <div id="ftFormArray" class="col-lg-12 layout-spacing">
                <?php echo $__env->make('admin.inc.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.inc.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4><?php echo e(isset($record_data) ? 'Update' : 'Create'); ?> Blog</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="<?php echo e(route('blogs.update', isset($record_data) ? base64_encode($record_data->blog_id) : base64_encode(0) )); ?>" method="POST" enctype="multipart/form-data" id="general_form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Blog Title <i>*</i></label>
                                    <input type="text" class="form-control basic" maxlength="150" name="blog_title" value="<?php echo e(old('blog_title', isset($record_data) ? $record_data->blog_title : '')); ?>" placeholder="Blog Title" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Blog Category <i>*</i></label>
                                    <select name="blog_category" class="form-control" required>
                                        <option value="">== Select Blog Category ==</option>
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e(old('blog_category', isset($record_data) ? $record_data->blog_type : '') == $cat->category_id  ? 'selected' : ''); ?> value="<?php echo e($cat->category_id); ?>"><?php echo e($cat->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Blog Details <i>*</i></label>
                                    <div class="widget-content widget-content-area p-0">
                                        <textarea id="product_details" name="blog_details"><?php echo e(old('blog_details', isset($record_data) ? $record_data->blog_details : '')); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label>Blog Photo <i>*</i></label>
                                    <input type="file" class="form-control" accept="image/*" name="blog_file" <?php echo e(isset($record_data) ? '' : 'required'); ?>>
                                    <input type="hidden" name="blog_img_name" value="<?php echo e(isset($record_data) ? $record_data->blog_image : ''); ?>">
                                    <?php if(isset($record_data) && !empty($record_data->blog_image)): ?>
                                        <div class="images-box-r" style="min-height: 320px;background: url(<?php echo e(asset('public/blog_image')); ?>/<?php echo e($record_data->blog_image); ?>"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save & Exit')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/admin/blogs/blog_create.blade.php ENDPATH**/ ?>