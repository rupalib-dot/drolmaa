<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                    <?php if(Session::get('role_id') == 3): ?>
                            <?php echo $__env->make('include.client_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php elseif(Session::get('role_id') == 2): ?>
                            <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <div class="col-md-9">
                            <div class="dashboard-panel">
                            <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3 class="order-content">My Orders</h3>
                                <form action="<?php echo e(route('appointment.index')); ?>" class="form-appoint">
                                    <select name="payment_type" style="border: 1px solid var(--black1);padding: 9px;margin-right: 5px !important;">
                                        <option value="">Order Number</option>
                                        <?php $__currentLoopData = config('constant.PAYMENT_MODE'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e(old('payment_type',$request['payment_type']) == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <input type="hidden" name="type" value="<?php echo e($request['type']); ?>" class="">

                                    <input style="margin-right: 5px !important;" type="date" name="from_date" value="<?php echo e(old('from_date',$request['from_date'])); ?>" class="mr-2">
                                    <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                    <a href="<?php echo e(url('appointment')); ?>"> <button type="button" class="filter" style="">Clear </button></a>
                                </form>
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Status</th> 
                                            <th>Payment Type</th>
                                            <th>Total</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($order)>0): ?>
                                            <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($getData->order_no); ?></td>
                                                    <td><?php echo e(date('M d, Y',strtotime($getData->created_at))); ?></td>
                                                    <td><?php echo e(array_search($getData['order_status'],config('constant.STATUS'))); ?></td> 
                                                    <td><?php echo e(array_search($getData['payment_type'],config('constant.PAYMENT_MODE'))); ?></td>
                                                    <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($getData->grand_total,2,'.',',')); ?></td>
                                                    <td class="cancel-icon">
                                                        <span class="view-icon" title="View Order"><a href="<?php echo e(route('customer.order_detail',$getData->order_id)); ?>"><i class="fas fa-eye"></i></a></span>
                                                        <!-- <span class="chat-icon"><a href="#"><i class="flaticon-chat"></i></a><span> -->
                                                        <?php if($getData->order_status == config('constant.STATUS.PENDING')): ?> 
                                                            <span onclick="return confirm('Are you sure you want to cancel this order?')" class="view-icon" title="Cancel"><a href="<?php echo e(route('order-status-change',['id'=>$getData->order_id,'status'=>config('constant.STATUS.CANCELLED')])); ?>"><i class="far fa-times-circle"></i></a></span> 
                                                        <?php endif; ?>
                                                        <?php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.ORDER"),'module_id',$getData->order_id);?>
                                                        <?php if(empty($exist)): ?>
                                                            <span class="view-icon" title="Feedback"><a style="cursor:pointer" onclick="addFeedback('1','<?php echo e($getData->order_id); ?>','<?php echo e(config("constant.FEEDBACK.ORDER")); ?>')"><i class="flaticon-view-details"></i></a></span> 
                                                        <?php else: ?>
                                                            <span class="view-icon" title="Feedback"><a href="<?php echo e(route('customer.feedback',['module_id'=>$getData->order_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>'1','module_type'=>config('constant.FEEDBACK.ORDER')])); ?>"><i class="flaticon-view-details"></i></a></span> 
                                                        <?php endif; ?>
                                                    </td>
                                                </tr> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td  colspan="6">No order available</td>
                                            </tr> 
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">
                            <?php echo e($order->appends($request->all())->render('vendor.pagination.custom')); ?>

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

<?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/orders/order.blade.php ENDPATH**/ ?>