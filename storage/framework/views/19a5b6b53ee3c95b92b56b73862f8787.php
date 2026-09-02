<div class="row justify-content-center statistics text-center bg-secondary-gradient text-light pt-3 pb-2">
    <?php $__currentLoopData = getStats(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 mb-3 col-lg-3 mb-lg-0 block">
            <p ><?php echo e($stat->title); ?></p>
            
            <h4 class=" d-block" data-countup data-start="4567"
                data-end="<?php echo e($stat->number); ?>" data-suffix=" <?php echo $stat->suffix; ?>" data-prefix="<?php echo $stat->prefix; ?>" data-duration="3" data-grouping="true"> </h4>
            
           
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\statistics.blade.php ENDPATH**/ ?>