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
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3 class="order-content"> Workshop/Webinar </h3> 
                         
                                <form action="<?php echo e(route('bookings.index')); ?>"class="form-appoint">
                                    <input type="date" name="from_date" value="<?php echo e($request['from_date']); ?>" class="">

                                    <input type="date" name="to_date" value="<?php echo e($request['to_date']); ?>" class="">
                                    <a href="#"> <button type="submit" class="filter" style="margin-left:0px">Filter</button></a>
                                    <a href="<?php echo e(url('bookings')); ?>"> <button type="button" class="filter" style="margin-left:0px">Clear Filter</button></a>
                                    
                                </form>
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Expert Name</th>
                                            <th>Designation</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Price</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($booking_list)>0): ?>
                                            <?php $__currentLoopData = $booking_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($booking->booking_no); ?></td>
                                                    <td><?php echo e(ucwords(strtolower(array_search($booking->module_type,config('constant.BOOKING'))))); ?></td>
                                                    <td><?php echo e($booking->title); ?></td> 
                                                    <td><?php echo e(CommonFunction::GetSingleField('users','full_name','user_id',$booking->expert)); ?></td>
                                                    <td><?php echo e(CommonFunction::GetSingleField('designation','designation_title','designation_id',$booking->designation)); ?></td>
                                                    <td><?php echo e(date('M d,Y',strtotime($booking->date))); ?></td>
                                                    <td><?php echo e(date('h:i A',strtotime($booking->time))); ?></td>
                                                    <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($booking->price,2,'.',',')); ?></td> 
                                                    <td>
                                                        <?php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.BOOKING"),'module_id',$booking->booking_id);?>
                                                        <?php if(empty($exist)): ?>
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" onclick="addFeedback('<?php echo e($booking->expert); ?>','<?php echo e($booking->booking_id); ?>','<?php echo e(config("constant.FEEDBACK.BOOKING")); ?>')"><i class="flaticon-view-details"></i></a></span> 
                                                        <?php else: ?>
                                                            <span class="view-icon" title="feedback"><a href="<?php echo e(route('customer.feedback',['module_id'=>$booking->booking_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>$booking->expert,'module_type'=>config('constant.FEEDBACK.BOOKING')])); ?>"><i class="flaticon-view-details"></i></a></span> 
                                                        <?php endif; ?> 
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8">No Record Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody> 
                                </table>
                            </div>
                            <div class="paginationPara">
                            <?php echo e($booking_list->appends($request->all())->render('vendor.pagination.custom')); ?>

                                <!-- <ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button class="page-next">Previouss</button></a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button class="page-next">Next</button></a></li>
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
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/customer_panel/booking.blade.php ENDPATH**/ ?>