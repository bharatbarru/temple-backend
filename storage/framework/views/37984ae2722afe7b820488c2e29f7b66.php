
<?php $emailLogoPath = emailLogoPath(); ?>
<?php if($emailLogoPath && isset($message)): ?>
    <img style="line-height: 1px; margin: 0; padding: 0; border: 0; display: block;" width="250"
        src="<?php echo e($message->embed($emailLogoPath)); ?>" alt="<?php echo e(emailLogoAltText()); ?>" />
<?php else: ?>
    <img style="line-height: 1px; margin: 0; padding: 0; border: 0; display: block;" width="250"
        src="<?php echo e(emailLogoUrl()); ?>" alt="<?php echo e(emailLogoAltText()); ?>" />
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\emails\partials\logo.blade.php ENDPATH**/ ?>