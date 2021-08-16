<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.client_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-md-9">
                            <div class="dashboard-panel">
                                <h3 class="order-content">My Feedbacks</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if(count($feedback_list['feedbackBy'])>0): ?>
                                            <?php $__currentLoopData = $feedback_list['feedbackBy']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedbackBy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="feedback-profile">
                                                    <div class="feedback-rating" style="width: 100%;">
                                                        <div class="data">
                                                            <div class="feedback-box"
                                                                style="background-image:url(<?php echo e(asset('front_end/images/blogimg.jpg')); ?>);">
                                                            </div>
                                                            <h3><?php echo e($feedbackBy->feedbackTo_users->full_name); ?></h3>
                                                            <p class="java-tech">Feedback On:- <?php echo e(ucwords(strtolower(array_search($feedbackBy->module_type,config('constant.FEEDBACK'))))); ?></p>
                                                        </div>
                                                        <div class="star" style="top: -70px;">
                                                            <!-- <span class="review-star"><?php echo e($feedbackBy->rating); ?></span> -->
                                                            <?php if($feedbackBy->rating == 1): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php elseif($feedbackBy->rating == 2): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php elseif($feedbackBy->rating == 3): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php elseif($feedbackBy->rating == 4): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php else: ?> 
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <p class="quote-feedback"
                                                        style="background-image:url(<?php echo e(asset('front_end/images/quoteimg.png')); ?>);">
                                                       <?php echo e($feedbackBy->message); ?>

                                                    </p>
                                                    <p style="padding-top: 15px;text-align: right;color: var(--black1);">
                                                       <?php echo e(date('M d, Y  H:i A',strtotime($feedbackBy->created_at))); ?>

                                                    </p>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php if(count($feedback_list['feedbackTo'])>0): ?>
                                            <?php $__currentLoopData = $feedback_list['feedbackTo']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedbackTo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <div class="feedback-profile">
                                                    <div class="feedback-rating" style="width: 100%;">
                                                        <div class="data">
                                                            <div class="feedback-box"
                                                                style="background-image:url(<?php echo e(asset('front_end/images/blogimg.jpg')); ?>)">
                                                            </div>
                                                            <h3><?php echo e($feedbackTo->feedbackBy_users->full_name); ?></h3>
                                                            <p class="java-tech">Feedback On:- <?php echo e(ucwords(strtolower(array_search($feedbackTo->module_type,config('constant.FEEDBACK'))))); ?></p>
                                                        </div>
                                                        <div class="star" style="top: -70px;">
                                                            <!-- <span class="review-star"><?php echo e($feedbackTo->rating); ?></span> -->
                                                            <?php if($feedbackTo->rating == 1): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php elseif($feedbackTo->rating == 2): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php elseif($feedbackTo->rating == 3): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php elseif($feedbackTo->rating == 4): ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php else: ?> 
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <p class="quote-feedback"
                                                        style="background-image:url(<?php echo e(asset('front_end/images/quoteimg.png')); ?>);">
                                                       <?php echo e($feedbackTo->message); ?>

                                                    </p>
                                                    <p style="padding-top: 15px;text-align: right;color: var(--black1);">
                                                       <?php echo e(date('M d, Y  H:i A',strtotime($feedbackTo->created_at))); ?>

                                                    </p>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if(count($feedback_list['feedbackBy'])<= 0 && count($feedback_list['feedbackTo'])<= 0): ?>
                                            <div class="feedback-profile">
                                                NO RECORD FOUND
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                           <div class="paginationPara">
                                <?php if(count($feedback_list['feedbackBy'])>0): ?>
                                    <?php echo e($feedback_list['feedbackBy']->appends($request->all())->render('vendor.pagination.custom')); ?>

                                <?php elseif(count($feedback_list['feedbackTo'])>0): ?>
                                    <?php echo e($feedback_list['feedbackTo']->appends($request->all())->render('vendor.pagination.custom')); ?>

                                <?php endif; ?>
                           
                                <!--<ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Previouss</button>
                                        </a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Next</button>
                                        </a>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/customer_panel/feedback.blade.php ENDPATH**/ ?>