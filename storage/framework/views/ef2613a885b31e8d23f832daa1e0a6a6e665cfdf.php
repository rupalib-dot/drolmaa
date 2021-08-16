<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style> 
.checked{
   color: #ffc800;
}
</style> 
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-md-10" style="padding-top: 40px;">
                            <div class="dashboard-panel">
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h4>Workshop Details</h4> 
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead> 
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th> 
                                            <th>Status</th>
                                            <th>Payment Id</th> 
                                            <th>Amount</th> 
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php if(count($users_list)>0): ?> 
                                            <?php $i=1; ?> 
                                            <?php $__currentLoopData = $users_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aGetData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr> 
                                                    <td><?php echo e($aGetData->booking_no); ?></td> 
                                                    <td><?php echo e($aGetData->Users->full_name); ?> </td>
                                                    <td><?php echo e($aGetData->Users->email_address); ?></td>
                                                    <td>+91 <?php echo e($aGetData->Users->mobile_number); ?></td>  
                                                    <td><?php echo e(ucwords(strtolower(array_search($aGetData->status,config('constant.STATUS'))))); ?></td>
                                                    <td><?php echo e($aGetData->payment_id); ?></td> 
                                                    <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format(CommonFunction::GetSingleField('workshop','price','workshop_id',$aGetData->module_id),2,'.',',')); ?></td>  
                                                </tr> 
                                            <?php $i++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        <?php else: ?>
                                            <tr> 
                                                <td colspan="9">No Record Found</td>
                                            </tr> 
                                        <?php endif; ?>  
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">  
                            <?php echo e($users_list->appends($request->all())->render('vendor.pagination.custom')); ?>

                                <!-- <ul class="pagination justify-content-center">
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
                                        </a></li>
                                </ul> -->
                            </div> 
                            <?php if(count($feedback_list)>0): ?>
                                <div class="dashboard-panel">
                                    <h4>Feedback Details</h4>  
                                    <?php $__currentLoopData = $feedback_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $image_name = CommonFunction::GetSingleField('users','user_image','user_id',$feedback->feedback_by); ?>
                                        <div class="feedback-profile" style="border: 1px solid #00000040;padding: 20px;">
                                            <div class="feedback-rating"> 
                                                <h4><?php echo e(CommonFunction::GetSingleField('users','full_name','user_id',$feedback->feedback_by)); ?></h4>
                                                <?php if($feedback->rating == 1): ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                <?php elseif($feedback->rating == 2): ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                <?php elseif($feedback->rating == 3): ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                <?php elseif($feedback->rating == 4): ?>
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
                                            <div class="star">
                                            <?php echo e($feedback->created_at); ?> 
                                            </div>
                                            <p class="quote-feedback" style="padding-top: 10px;padding-left: 0px; margin-bottom: 0px;">
                                                <?php echo e($feedback->message); ?>

                                            </p>
                                             
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </div>  
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


 

<?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/expert_panel/workshop/detail.blade.php ENDPATH**/ ?>