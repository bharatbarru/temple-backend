<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
       
        </div>
    </section>

    <div class="content px-3">
    <?php echo $__env->make('pujas.show_fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pujas\show.blade.php ENDPATH**/ ?>