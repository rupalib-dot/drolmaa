

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <?php echo $__env->make('admin.inc.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.inc.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4> Workshops Listing </h4>
                            </div>
                        </div>
                    </div>
                    <!-- <form action="" method="GET">
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" maxlenght="6" class="form-control mb-3 mb-md-0" name="coupon_code" placeholder="Coupon Code" value="<?php echo e($request->coupon_code); ?>" onkeypress="return IsAlphaNum(event, this.value, '6')"> 
                                </div>
                                <div class="col-md-4 d-flex">
                                    <button class="btn btn-primary mr-3" type="submit">
                                        Filter
                                    </button>
                                    <button class="btn btn-danger" type="button" id="ClearFilter">
                                        Clear Filter
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead> 
                                    <tr> 
                                        <th>S.No</th>
                                        <th>Title</th> 
                                        <th>Experts</th>  
                                        <th>Designation</th>  
                                        <th>Price</th>
                                        <th>Date</th> 
                                        <th>Time</th> 
                                        <th>Booking Counts</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php if(count($workshop)>0): ?> 
                                        <?php $i=1; ?> 
                                        <?php $__currentLoopData = $workshop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aGetData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            <tr> 
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($aGetData->title); ?></td> 
                                                <td><?php echo e($aGetData->expertUsers->full_name); ?></td>
                                                <td><?php echo e($aGetData->designations->designation_title); ?></td> 
                                                <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->price,2,'.',',')); ?></td>
                                                <td><?php echo e(date('d M,Y',strtotime($aGetData->date))); ?></td> 
                                                <td><?php echo e(date('H:i A',strtotime($aGetData->time))); ?></td>
                                                <td><?php echo e(CommonFunction::workshopBookedCount($aGetData->workshop_id)); ?></td>
                                                <td>
                                                    <span class="view-icon" title="delete"><a onclick="return confirm('Are you sure you want to delete this workshop?')" href="<?php echo e(route('workshop.delete',$aGetData->workshop_id)); ?>" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                    <span class="view-icon" title="Edit"><a href="<?php echo e(route('workshop.edit',$aGetData->workshop_id)); ?>" style="cursor:pointer"><i class="fas fa-edit"></i></a></span> 
                                                    <span class="view-icon" title="view"><a href="<?php echo e(route('workshop.show',$aGetData->workshop_id)); ?>" style="cursor:pointer"><i class="fas fa-eye"></i></a></span>   
                                                </td>
                                            </tr> 
                                        <?php $i++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    <?php else: ?>
                                        <tr> 
                                            <td colspan="8">No Record Found</td>
                                        </tr> 
                                    <?php endif; ?>  
                                </tbody>
                            </table>
                        </div> 
                        <div class="paginating-container pagination-solid justify-content-end">
                            <?php echo e($workshop->appends($request->all())->render('vendor.pagination.custom')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/admin/workshop/list.blade.php ENDPATH**/ ?>