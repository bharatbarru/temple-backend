<div class="faq">
    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="border-bottom pb-3 mb-3 faq-item">
            <div data-target="#panel-<?php echo e($faq->id); ?>" class="accordion-panel-title" data-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="panel-<?php echo e($faq->id); ?>">
                <h3 class="mb-0"><?php echo e($faq->question); ?></h3>
                <span class="material-symbols-outlined plus-icon" >
                    add
                </span>
                <span class="material-symbols-outlined minus-icon">
                    remove
                </span>
            </div>
            <div class="collapse " id="panel-<?php echo e($faq->id); ?>">
                <div class="pt-3">
                    <div class="des">
                        <?php echo $faq->answer; ?>


                        <?php if($faq->button_name): ?>
                        <a class="btn btn-primary btn-sm" target="<?php echo e($faq->new_window ? '_blank' : '_self'); ?>"
                            href="<?php echo e($faq->button_url); ?>">
                            <?php echo e($faq->button_name); ?>

                        </a>
                    <?php endif; ?>
                        


                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\common\faqs.blade.php ENDPATH**/ ?>