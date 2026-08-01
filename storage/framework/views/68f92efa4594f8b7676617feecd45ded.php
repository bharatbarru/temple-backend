<?php if(session()->has('flash_notification')): ?>
    <?php $__currentLoopData = session('flash_notification')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $level = $message->level == 'danger' ? 'error' : $message->level;
        ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
            }
            toastr.<?php echo e($level); ?>('<?php echo $message->message; ?>');
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/common/flash-toastr-message.blade.php ENDPATH**/ ?>