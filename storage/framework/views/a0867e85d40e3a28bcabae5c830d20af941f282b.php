<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/perticuler_blog.svg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="hall-heading">Blogs Category</h2>
            </div>
        </div>
    </div>
</section>
<section id="blog-inner">
    <div class="container">
        <div class="row">
            <?php if(count($category) >0 ){
                foreach($category as $categorys){?>
                    <a href="<?php echo e(route('page.bloglist',$categorys->category_id)); ?>">
                        <div class="col-md-4"> 
                            <div class="card blog-success">
                                <img height= 235px; src="<?php echo e(asset('storage/category/'.$categorys->category_image)); ?>" class="card-img-top" alt="...">
                                <div class="card-body">    
                                        <h3 class="card-title text-dark"><?php echo e($categorys->category_name); ?></h3> 
                                        <a href="<?php echo e(route('page.bloglist',$categorys->category_id)); ?>" class="read-more">View Blogs</a>
                                </div>
                            </div> 
                        </div>
                    </a>
            <?php } } ?> 
        </div>
    </div>
</section>
 
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/pages/all_blog_category.blade.php ENDPATH**/ ?>