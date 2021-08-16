<?php if($paginator->hasPages()): ?>
    <ul class="pagination" style="margin-left: 50%;">
        <?php if($paginator->onFirstPage()): ?>
            <li class="prev disabled" style=" border:1px solid black;padding: 10px;"><a href="javascript:void(0);"> <i style="color:#0056b3" class="fas fa-backward"></i> </a></li>
        <?php else: ?>
            <li class="prev" style=" border:1px solid black;padding: 10px;"><a href="<?php echo e($paginator->previousPageUrl()); ?>"><i style="color:#0056b3" class="fas fa-backward"></i></a></li>
        <?php endif; ?>
        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
            <?php if(is_string($element)): ?>
                <li class="disabled" style=" border:1px solid black;padding: 10px;"><span><a href="javascript:void(0);"><?php echo e($element); ?></a></span></li>
            <?php endif; ?>


           
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active my-active" style=" border:1px solid black;padding: 10px;"><span><a href="javascript:void(0);"><?php echo e($page); ?></a></span></li>
                    <?php else: ?>
                        <li style="border:1px solid black;padding: 10px;"><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!-- 9799832163  (preeti) -->
        <?php if($paginator->hasMorePages()): ?>
            <li class="next" style=" border:1px solid black;padding: 10px;"><a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><i style="color:#0056b3" class="fas fa-forward"></i></a></li>
        <?php else: ?>
            <li class="disabled" style=" border:1px solid black;padding: 10px;"><span><a href="javascript:void(0);"><i style="color:#0056b3" class="fas fa-forward"></i> </a></span></li>
        <?php endif; ?>

         
    </ul>
<?php endif; ?><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>