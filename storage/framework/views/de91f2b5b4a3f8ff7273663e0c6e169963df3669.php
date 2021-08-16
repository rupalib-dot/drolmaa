

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
                                <h4>Categorys Listing</h4>
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
                                        <th>Name</th>   
                                        <th>Image</th>   
                                        <th> Status </th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php if(count($category)>0): ?> 
                                        <?php $i=1; ?> 
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aGetData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            <tr>  
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($aGetData->category_name); ?></td>   
                                                <td>  <img style="width: 80px;" src="<?php if(!empty($aGetData->category_image)){?><?php echo e(asset('storage/category/'.$aGetData->category_image)); ?><?php }else{?><?php echo e(asset('front_end/images/blogimg.jpg')); ?><?php }?>"> </td>
                                                <td><?php echo e(ucwords(strtolower(array_search($aGetData->category_status,config('constant.BLK_UNBLK'))))); ?></td>
                                                <td>
                                                    <?php if($aGetData->category_status == config('constant.BLK_UNBLK.BLOCK')): ?>
                                                        <span class="view-icon" title="Unblock"><a onclick="return confirm('Are you sure you want to unblock this category?')" href="<?php echo e(route('category.changeStatus',['id'=>$aGetData->category_id,'status'=>config('constant.BLK_UNBLK.UNBLOCK')])); ?>" style="cursor:pointer"><i class="fas fa-check"></i></a></span>
                                                    <?php elseif($aGetData->category_status == config('constant.BLK_UNBLK.UNBLOCK')): ?>
                                                        <span class="view-icon" title="Block"><a onclick="return confirm('Are you sure you want to block this category?')" href="<?php echo e(route('category.changeStatus',['id'=>$aGetData->category_id,'status'=>config('constant.BLK_UNBLK.BLOCK')])); ?>" style="cursor:pointer"><i class="fas fa-times"></i></a></span>
                                                    <?php endif; ?>
                                                    <span class="view-icon" title="Delete"><a onclick="return confirm('Are you sure you want to delete this category?')" href="<?php echo e(route('category.delete',$aGetData->category_id)); ?>" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                    <span class="view-icon" title="Edit"><a href="<?php echo e(route('category.edit',$aGetData->category_id)); ?>" style="cursor:pointer"><i class="fas fa-edit"></i></a></span>  
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
                            <?php echo e($category->appends($request->all())->render('vendor.pagination.custom')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/admin/category/list.blade.php ENDPATH**/ ?>