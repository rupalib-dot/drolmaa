<?php if($errors->any()): ?>
    <div class="error-bg mb-2">
        <div class="font-medium text-red-600"><?php echo e(__('Whoops! Something went wrong')); ?></div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/admin/inc/validation_message.blade.php ENDPATH**/ ?>