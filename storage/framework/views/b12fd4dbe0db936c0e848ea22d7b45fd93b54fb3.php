<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
    <section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0  container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-md-10">
                            <div class="dashboard-panel">
                                <h3 class="order-content"><?php echo e(ucwords($type)); ?> Transaction Listings</h3>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <?php if($type == 'registration'){ ?>
                                                <!-- <th>Total Collection</th>     -->
                                            <?php }else if($type == 'appointment'){  ?>
                                                <th>Amount earned </th>
                                                <th>Amount Paid By Admin</th> 
                                                <th>Amount Left</th>
                                            <?php  } ?> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr> 
                                            <?php if($type == 'registration'){ ?>
                                                <td> Total Spend:- <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($TotalColection,2,'.',',')); ?> </td>  
                                            <?php }else if($type == 'appointment'){  ?>
                                                <td> <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($TotalColection,2,'.',',')); ?></td>  
                                                <td> <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($totalPaidamount,2,'.',',')); ?> </td> 
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format(($TotalColection - $totalPaidamount),2,'.',',')); ?></td>
                                            <?php  } ?>
                                        <tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <th>ID</th>  
                                            <?php if($type == 'appointment'){ ?> 
                                                <th>Date</th>
                                                <th>Appointment No</th>
                                                <th>Appoinment Date</th>
                                                <th>Payment Id</th>
                                                <th>Amount</th> 
                                                <th>Refund Id</th>
                                                <th>Refund Amount</th>    
                                            <?php } if($type == 'registration'){ ?>
                                                <th>Payment Id</th>
                                                <th style="width: 15%;">Amount</th> 
                                                <th>Start Date</th> 
                                                <th>End Date</th> 
                                                <th>Month</th>  
                                                <th>Plan Detail</th>  
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php if(count($transactions)>0): ?> 
                                            <?php $i=1; ?> 
                                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aGetData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                                <tr> 
                                                    <td><?php echo e($i); ?></td>
                                                    <?php if($type == 'registration'){ ?> 
                                                        <td><?php echo e($aGetData->payment_id); ?></td>
                                                        <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->register_amount,2,'.',',')); ?></td>
                                                        <td><?php echo e(date('d M, Y',strtotime($aGetData->start_date))); ?></td>
                                                        <td><?php echo e(date('d M, Y',strtotime($aGetData->end_date))); ?></td>
                                                        <td><?php echo e($aGetData->month); ?> Month</td>
                                                        <td><?php echo e(ucwords($aGetData->plan_detail)); ?></td>
                                                    <?php }else if($type == 'appointment'){  ?>
                                                        <td><?php echo e(date('d M, Y',strtotime($aGetData->created_at))); ?></td>
                                                        <td><?php echo e($aGetData->appoinment_no); ?></td>
                                                        <td><?php echo e(date('d M, Y',strtotime($aGetData->date))); ?></td>
                                                        <td><?php echo e($aGetData->payment_id); ?></td> 
                                                        <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->amount,2,'.',',')); ?></td>
                                                        <td><?php if(!empty($aGetData->refund_id)): ?> <?php echo e($aGetData->refund_id); ?>  <?php else: ?> N/A <?php endif; ?> </td>
                                                        <td><?php if(!empty($aGetData->amount_refund)): ?> <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->amount_refund,2,'.',',')); ?>  <?php else: ?> N/A <?php endif; ?></td>  
                                                    <?php  } ?>
                                                </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        <?php else: ?>
                                            <tr> 
                                                <td colspan="7">No Record Found</td>
                                            </tr> 
                                        <?php endif; ?>  
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">
                            <?php echo e($transactions->appends($request->all())->render('vendor.pagination.custom')); ?>

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
<?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/expert_panel/trans-list.blade.php ENDPATH**/ ?>