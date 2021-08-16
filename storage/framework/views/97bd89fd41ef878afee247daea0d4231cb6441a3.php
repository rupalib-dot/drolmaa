<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/perticuler_blog.svg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading"> Blog Detail</h2>
            </div>
        </div>
    </div>
</section>
<section id="single-blog" class="single-blog" role="single-blog">
    <div class="container">
    <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="single-contact">
                    <img style="height: 300px;" src="<?php echo e(asset('public/blog_image/'.$blog->blog_image)); ?>" alt="" class="img-fluid">
                    <ul class="comment-date" style="padding-left: 0px;margin-bottom: 20px;margin-top: 20px;">
                        <li> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span><?php echo e(date('M d, Y',strtotime($blog->created_at))); ?></li>
                        <li> <span><i class="fa fa-comment-o" aria-hidden="true"></i></span><?php echo e(count($blogs_comment)); ?> Comments</li>
                    </ul> 
                    <h4><?php echo e($blog->blog_title); ?></h4>
                    <p class="sucess-para"> <?php echo e($blog->blog_details); ?> </p>
                    <!-- Button trigger modal -->
                    <button type="button" class="my-3 border-0 float-right text-decoration-underline  text-dark " data-toggle="modal" data-target="#exampleModal">View All</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLabel"> Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <?php if(count($blogs_comment)>0): ?>
                                <?php $__currentLoopData = $blogs_comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogcomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $byimage = CommonFunction::GetSingleField('users','user_image','user_id',$blogcomment->user_id);
                                if(!empty($byimage)){
                                    $images = asset('public/user_images/'.$byimage);
                                }else{
                                    $images = asset('front_end/images/blogimg.jpg');
                                }
                                ?>

                                <div class="row py-3" style="">
                                <div class="col-lg-4" style="font-size: 15px; "> <img style="border-radius: 100%;  width: 50px; height: 50px;" src="<?php echo e($images); ?>"></div> 
                                <div class="col-lg-4" style="font-size: 15px;   font-weight: 700;"> <p><?php echo e(CommonFunction::GetSingleField('users','full_name','user_id',$blogcomment->user_id)); ?></p></div> 
                                    <div class="col-lg-12" style="font-size: 15px;"><p><?php echo e($blogcomment->comment_details); ?></p></div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <p> No comment found</p>
                            <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <h3 class="success-heading">Leave a Reply</h3>
                    <p class="email-para">Your email address will not be published. Required fields are marked *
                    </p>
                    <form action="<?php echo e(route('page.postComment',$blogId)); ?>" method="post" class="form-contact">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" name="full_name" value="NULL">
                            <input  type="hidden" name="email_address" value="NULL">
                            <input type="hidden" name="user_id" value="<?php echo e(Session::get('user_id')); ?>"> 
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" class="form-control" rows="5" id="comment" required><?php echo e(old('comment')); ?></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div> -->
                        </div> 
                                <button name="submit" type="submit" class="submit-contact">Post Comment</button>
                            
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="resend-post">
                    <h4 class="mb-3">Recent Post</h4>
                        <?php if(count($recent_blogs)): ?>
                            <?php $__currentLoopData = $recent_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent_blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card p-1 mb-3" style="max-width: 540px;">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('public/blog_image/'.$recent_blog->blog_image)); ?>" alt="" class="img-fluid one">
                                        <div class="post-right">
                                            <a href="<?php echo e(route('page.blogDetail',$recent_blog->blog_id)); ?>" target="_blank" rel="noopener noreferrer"><h5><?php echo e($recent_blog->blog_title); ?></h5></a>
                                            <p style="display:block;white-space: nowrap; overflow: hidden;  max-width: 170px; "> <?php echo e($recent_blog->blog_details); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                                 
                    <div class="text-center">
                    <a href="<?php echo e(route('page.bloglist',$blog->blog_type)); ?>" class="btn btn-danger text-center">Browse More</a>
                    </div>
                </div>
                <div class="offer-class">
                    <img src="<?php echo e(asset('front_end/images/group4.png')); ?>" alt="" class="img-fluid cutoff">
                    <div class="question-fill">
                   
                        <h4 class="any-ques">Talk to our Expert</h4>
                        <form action="<?php echo e(route('contact-submit')); ?>" method="post" class="form-contact">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e(config('constant.ENQUIERY.TALK TO EXPERT')); ?>" name="module_type">
                            <input type="hidden" value="0" name="module_id">
                            <input type="hidden" value="0" name="topic_id"> 
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                <input type="text" maxlength="30" class="form-control" value="<?php echo e(old('name')); ?>" placeholder="Name" name="name"  required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                <input type="email" class="form-control" value="<?php echo e(old('email')); ?>" name="email" placeholder="Email" aria-describedby="emailHelp" placeholder="Enter email"required>
                                </div>
                            </div> 
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                <input type="text"  maxlength="12" class="form-control" value="<?php echo e(old('phone')); ?>" placeholder="Phone" name="phone"  required>
                                </div>
                            </div> 
                            <div class="col-sm-12">
                            <textarea class="form-control" name="message" maxlength="250" id="exampleFormControlTextarea1" rows="3" required><?php echo e(old('message')); ?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="send-ques">Send</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/pages/blog_details.blade.php ENDPATH**/ ?>