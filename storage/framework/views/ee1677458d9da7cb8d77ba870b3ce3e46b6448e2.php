<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/perticuler_blog.svg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="hall-heading"><?php echo e(CommonFunction::GetSingleField('category','category_name','category_id',$catid)); ?> Blogs</h2>
            </div>
        </div>
    </div>
</section>
<section id="blog-inner">
    <div class="container">
        <div class="row">
            <?php if(count($blogs) >0 ){
                foreach($blogs as $blog){ ?>
                    <a href="<?php echo e(route('page.blogDetail',$blog->blog_id)); ?>">
                        <div class="col-md-4"> 
                            <div class="card blog-success" style=" height: 320px;">
                                <img style=" height: 120px;" src="<?php echo e(asset('public/blog_image/'.$blog->blog_image)); ?>" class="card-img-top" alt="...">
                                <div class="card-body">    
                                        <h3 class="card-title text-dark"><?php echo e($blog->blog_title); ?></h3>
                                        <p class="text-left"  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; "> <?php echo e($blog->blog_details); ?></p>
                                        <a href="<?php echo e(route('page.blogDetail',$blog->blog_id)); ?>" class="read-more">Read More</a>
                                </div>
                            </div> 
                        </div>
                    </a>
            <?php }}else{?>
                <div class="col-md-12">  
                    <h3 style="text-align: center;">No Record Found</h3> 
                </div>
            <?php } ?>
        </div>
    </div>
</section>
 
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/pages/blog.blade.php ENDPATH**/ ?>