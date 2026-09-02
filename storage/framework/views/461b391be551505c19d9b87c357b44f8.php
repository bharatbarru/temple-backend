<?php
    $ourServices = getServiceCategory('our-services');
?>
<?php if($ourServices): ?>
    <section class="our-services pt-3 pb-2">
        <div class="container">
            <div class="text-center">
            <h2 class="lead font-700 text-tertiary title-center mb-5"><?php echo e($ourServices->display_name); ?></h2>
            </div>
            <div class="mt-5 row our-service-list">
                <?php $serviceCount = 0; ?>
                <?php $__currentLoopData = $ourServices->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($serviceCount < 3): ?>
                        <div class="col-md-4 text-center block mb-3" data-aos="fade-in" data-aos-duration="1500">
                            <div class="card h-100 transition">
                                <div class="card-body d-flex flex-column">
                                    <a href="<?php echo e(url('services/' . $ourService->slug)); ?>" class="thumbnail mb-3 d-block">
                                        <img class="w-100 h-100 object-fit-contain object-fit-center-postion"
                                            src="<?php echo e(asset(SERVICE_IMAGE_PATH . $ourService->image)); ?>"
                                            alt="<?php echo e($ourService->image_alt_text); ?>">
                                    </a>
                                    <a href="<?php echo e(url('services/' . $ourService->slug)); ?>">
                                        <h5 class="font-700 h1"><?php echo e($ourService->title); ?></h5>
                                    </a>
                                    <div class="flex-grow-1 lead">
                                        <?php echo $ourService->short_description; ?>

                                    </div>
                                    <div class="text-center">
                                    <a class="btn btn-default d-inline-block font-400" href="<?php echo e(url('services/' . $ourService->slug)); ?>"><span class="material-symbols-outlined">
                                        add
                                        </span> Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $serviceCount++; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($ourServices->services->count() > 3): ?>
                <div class="text-center mt-5">
                    <a class="btn btn-primary" href="/services">View All Services</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-services.blade.php ENDPATH**/ ?>