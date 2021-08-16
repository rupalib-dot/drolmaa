<?php if(Session::has('Failed')): ?>
    <div class="error-bg mb-2">
        <div class="font-medium text-red-600"><?php echo e(__('Whoops! Something went wrong')); ?></div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li><?php echo e(Session::get('Failed')); ?></li>
        </ul>
    </div>
<?php endif; ?>

<?php if(Session::has('Success')): ?>
    <div class="success-bg mb-2">
        <div class="font-medium text-green-600"><?php echo e(Session::get('Success')); ?></div>
    </div>
<?php endif; ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/admin/inc/auth_message.blade.php ENDPATH**/ ?>