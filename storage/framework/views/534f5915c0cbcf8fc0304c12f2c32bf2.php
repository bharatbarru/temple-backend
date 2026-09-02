<?php if($faqCategory): ?>
    <?php echo $__env->make('common.faqs', ['faqs' => $faqCategory->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\our-faqs.blade.php ENDPATH**/ ?>