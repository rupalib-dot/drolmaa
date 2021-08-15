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
                                <h3 class="order-content"><?php echo e(ucwords($type)); ?> Transaction Listings</h3>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <?php if($type == 'order'){ ?>
                                                <th>Amount Spend</th>
                                                <th>Amount Refund</th>
                                                <th>Total Spend</th>  
                                            <?php }else if($type == 'booking'){ ?>
                                                <!-- <th>Total Collection</th>     -->
                                            <?php }else if($type == 'appointment'){  ?>
                                                <th>Amount Spend </th>
                                                <th>Amount Refund</th>
                                                <th>Total Spend</th>   
                                            <?php  } ?> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr> 
                                            <?php if($type == 'order'){ ?>
                                                <td>  <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($amountearned,2,'.',',')); ?></td> 
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($amountrefund,2,'.',',')); ?></td>
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($TotalColection,2,'.',',')); ?> </td>  
                                            <?php }else if($type == 'booking'){ ?>
                                                <td> Total Spend:- <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($TotalColection,2,'.',',')); ?> </td>  
                                            <?php }else if($type == 'appointment'){  ?>
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($amountearned,2,'.',',')); ?></td> 
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($amountrefund,2,'.',',')); ?></td>
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($TotalColection,2,'.',',')); ?> </td>  
                                            <?php  } ?>
                                        <tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Payment Id</th>
                                            <th>Amount</th> 
                                            <?php if($type == 'order'){ ?>   
                                                    <th>Refund Id</th>
                                                    <th>Refund Amount</th>  
                                            <?php }else if($type == 'appointment'){ ?> 
                                                    <th>Refund Id</th>
                                                    <th>Refund Amount</th>    
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php if(count($transactions)>0): ?> 
                                            <?php $i=1; ?> 
                                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aGetData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                                <tr> 
                                                    <?php if($type == 'order'){ ?> 
                                                        <td><a style="color:blue" href="<?php echo e(route('customer.order_detail',$aGetData->order_id)); ?>"><?php echo e($aGetData->order_no); ?></a></td>
                                                        <td><?php echo e(date('d M, Y',strtotime($aGetData->created_at))); ?></td>
                                                        <td><?php echo e($aGetData->payment_id); ?></td> 
                                                        <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->grand_total,2,'.',',')); ?></td> 
                                                        <td><?php if(!empty($aGetData->refund_id)): ?> <?php echo e($aGetData->refund_id); ?> <?php else: ?> N/A <?php endif; ?></td>
                                                        <td><?php if(!empty($aGetData->refund_amount)): ?> <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->refund_amount,2,'.',',')); ?> <?php else: ?> N/A <?php endif; ?></td>   
                                                    <?php }else if($type == 'booking'){ ?>
                                                        <td><?php echo e($aGetData->booking_no); ?></td>
                                                        <td><?php echo e(date('d M, Y',strtotime($aGetData->date))); ?></td>
                                                        <td><?php echo e($aGetData->payment_id); ?></td> 
                                                        <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->price,2,'.',',')); ?></td>
                                                    <?php }else if($type == 'appointment'){  ?>
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
                            <div class="mb-4 paginationPara">
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
<?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/customer_panel/trans-list.blade.php ENDPATH**/ ?>