<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.client_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-lg-10">
                            <div class="dashboard-panel">
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3>My Appointments</h3>
                                <a href="<?php echo e(route('appointment.index',['type'=>'current'])); ?>"> <button class="mb-3 <?php if(!isset($request['type']) || $request['type'] == 'current'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Current Appointment</button></a>
                                <a href="<?php echo e(route('appointment.index',['type'=>'previous'])); ?>"> <button class="<?php if($request['type'] == 'previous'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Previous Appointment</button></a>
                                <form action="<?php echo e(route('appointment.index')); ?>" class="form-appoint">
                                    <input type="hidden" name="type" value="<?php echo e($request['type']); ?>" class="">
                                    <div class="row">
                                        <div class="my-3 col-md-4">
                                            <input type="date" name="from_date" value="<?php echo e(old('from_date',$request['from_date'])); ?>" class="form-control mr-2">
                                        </div>
                                        <div class="my-3 col-md-4">
                                            <input type="date" name="to_date" value="<?php echo e(old('to_date',$request['to_date'])); ?>" class="form-control mr-2">
                                        </div>
                                        <div class="my-3 col-md-4">
                                            <select name="payment_type" style="border: 1px solid var(--black1);padding: 9px;margin-right: 5px !important;">
                                                <option value="">Select Payment</option>
                                                <?php $__currentLoopData = config('constant.PAYMENT_MODE'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(old('payment_type',$request['payment_type']) == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                    <a href="<?php echo e(url('appointment')); ?>"> <button type="button" class="filter" style="">Clear </button></a>
                                </form>
                                <table class="table-responsive table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Expert Name</th>
                                            <th>Plan</th>
                                            <th>Designation</th>
                                            <th>Payment</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($appointment_list)>0): ?>
                                        <?php $__currentLoopData = $appointment_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($appointment->appoinment_no); ?></td>
                                                <td><?php echo e(date('M d,Y',strtotime($appointment->date))); ?></td>
                                                <td><?php echo e(date('h:i A',strtotime($appointment->time)) .' - '. date("h:i A",strtotime('+1 hours',strtotime($appointment->time)))); ?></td>
                                                <td><?php echo e($appointment->expertUsers->full_name); ?></td>
                                                <td><?php echo e(ucwords(strtolower(array_search($appointment->plan,config('constant.PLAN'))))); ?></td>
                                                <td><?php echo e($appointment->designations->designation_title); ?></td>
                                                <td><?php echo e(ucwords(strtolower(array_search($appointment->payment_mode,config('constant.PAYMENT_MODE'))))); ?></td>
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($appointment->amount, 2, '.', '')); ?></td>
                                                <td>
                                                
                                               <?php  $time1 = strtotime(date('Y-m-d H:i:s'));$time2 = strtotime(date('Y-m-d H:i:s',strtotime($appointment->date.' '.$appointment->time))); $difference = round(($time2 - $time1) / 3600);?>
                                                    <?php if($appointment->status == config('constant.STATUS.PENDING') || $appointment->status == config('constant.STATUS.ACCEPTED')): ?>
                                                        <?php if($difference >= 48): ?>
                                                            <span onclick="return confirm('Are you sure you want to cancel this appoinment?')" class="view-icon" title="cancel"><a href="<?php echo e(route('appointment.cancelAppoinment',['id'=>$appointment->appointment_id,'status'=>config('constant.STATUS.CANCELLED')])); ?>"><i class="fas fa-ban"></i></a></span>
                                                        <?php else: ?>
                                                            <?php echo e(ucwords(strtolower(array_search($appointment->status,config('constant.STATUS'))))); ?>

                                                        <?php endif; ?>
                                                    <?php elseif($appointment->status == config('constant.STATUS.COMPLETED')): ?>
                                                        <?php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.APPOINMENT"),'module_id',$appointment->appointment_id);?>
                                                        <?php if(empty($exist)): ?>
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" onclick="addFeedback('<?php echo e($appointment->expert); ?>','<?php echo e($appointment->appointment_id); ?>','<?php echo e(config("constant.FEEDBACK.APPOINMENT")); ?>')"><i class="flaticon-view-details"></i></a></span> 
                                                        <?php else: ?>
                                                            <span class="view-icon" title="feedback"><a href="<?php echo e(route('customer.feedback',['module_id'=>$appointment->appointment_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>$appointment->expert,'module_type'=>config('constant.FEEDBACK.APPOINMENT')])); ?>"><i class="flaticon-view-details"></i></a></span> 
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php echo e(ucwords(strtolower(array_search($appointment->status,config('constant.STATUS'))))); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7">No Record Found</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                            <div class="paginationPara">  
                                <?php echo e($appointment_list->appends($request->all())->render('vendor.pagination.custom')); ?>

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
 
 
  <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/customer_panel/appointment.blade.php ENDPATH**/ ?>