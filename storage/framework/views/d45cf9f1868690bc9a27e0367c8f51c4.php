<?php
    $groupCompanies = getClienteleCategory('group-companies');
?>
<?php if($groupCompanies): ?>
    <section class="group-companies pt-0">
        <div class="container">
            <div class="section-title text-center ">
                <h2><?php echo e($groupCompanies->display_name); ?></h2>
                <p class="font-color"><?php echo e($groupCompanies->tagline); ?></p>
            </div>
            <div class="four-items-slider our-brands-list mt-5">
                <?php $__currentLoopData = $groupCompanies->clienteles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupCompany): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item ">
                        <div class="card text-center mx-2 p-3">
                            <?php if($groupCompany->url): ?>
                                <a class="d-block" href="<?php echo e($groupCompany->url); ?>" <?php if($groupCompany->new_window == 'yes'): ?> target="_blank" <?php endif; ?> >
                                    <figure class="m-0 p-2"> <img class="m-auto d-block"
                                            src="<?php echo e(asset(CLIENTELE_IMAGE_PATH . $groupCompany->image)); ?>"
                                            alt="<?php echo e($groupCompany->image_alt_text); ?>"></figure>
                                    <p class="lead font-color"><?php echo e($groupCompany->title); ?></p>
                                </a>
                            <?php else: ?>
                                <figure class="m-0 p-2"> <img class="m-auto d-block"
                                        src="<?php echo e(asset(CLIENTELE_IMAGE_PATH . $groupCompany->image)); ?>"
                                        alt="<?php echo e($groupCompany->image_alt_text); ?>"></figure>
                                <p class="lead font-color"><?php echo e($groupCompany->title); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
<?php endif; ?>
</section>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-group-companies.blade.php ENDPATH**/ ?>