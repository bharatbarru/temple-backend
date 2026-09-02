<?php
    $ourCaterings = getServiceCategory('caterings');
?>
<?php if($ourCaterings): ?>
<?php if($ourCaterings->display_name || $ourCaterings->tagline ): ?>
    <div class="section-title text-center">
        <h2 class="font-color"><?php echo e($ourCaterings->display_name); ?></h2>
        <p class="font-color"><?php echo $ourCaterings->tagline; ?></p>
    </div>
<?php endif; ?>
<div class="caterings-list">
    <?php $__currentLoopData = $ourCaterings->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourCatering): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row mt-5 align-items-center justify-content-around block">
            <div class="col-md-5 col-xl-6 mb-4 mb-md-0 pic">
                <img class="w-100 shadow-3d" src="<?php echo e(asset(SERVICE_IMAGE_PATH . $ourCatering->image)); ?>"
                    alt="<?php echo e($ourCatering->image_alt_text); ?>">
            </div>
            <div class="col-md-7 col-xl-6 content">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="my-3"><span class="h1 font-color"><?php echo e($ourCatering->title); ?></span></div>
                        <?php echo $ourCatering->description; ?>

                        <?php if($ourCatering->custom_url): ?>
                        <a class="btn btn-primary mt-5" href="<?php echo e($ourCatering->custom_url); ?>"
                            <?php if($ourCatering->new_window == 'yes'): ?> target="_blank" <?php endif; ?>>View Gallery</a>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-caterings.blade.php ENDPATH**/ ?>