<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <?php echo $__env->make('admin.inc.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.inc.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4><?php echo e(__('Manage Blog')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Blog Category</th>
                                        <th>Details</th>
                                        <th>Image</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($record_list) > 0): ?>
                                        <?php $__currentLoopData = $record_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="max-width: 200px;"><?php echo e($record->blog_title); ?></td>
                                                <td><?php echo e(CommonFunction::GetSingleField('category','category_name','category_id',$record->blog_type)); ?> </td>
                                                <td style="max-width: 550px;"><?php echo e($record->blog_details); ?></td>
                                                <td><img src="<?php echo e(asset('public/blog_image')); ?>/<?php echo e($record->blog_image); ?>" width="100" /></td>
                                                <td><?php echo e(date('d F, Y', strtotime($record->created_at))); ?></td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <li><a href="<?php echo e(route('blogs.edit',base64_encode($record->blog_id))); ?>" data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a></li>
                                                        <li><span class="view-icon" title="view"><a href="<?php echo e(route('blogs.show',base64_encode($record->blog_id))); ?>" style="cursor:pointer"><i class="fas fa-eye"></i></a></span>   </li>
                                                        <li>
                                                            <form action="<?php echo e(route('blogs.destroy',base64_encode($record->blog_id))); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <buttton type="submit" class="delete-user" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr><td colspan="6" align="center"><strong>No record's found</strong></td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="paginating-container pagination-solid justify-content-end">
                            <?php echo e($record_list->render('vendor.pagination.custom')); ?>

                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/admin/blogs/blog_list.blade.php ENDPATH**/ ?>