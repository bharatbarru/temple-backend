<?php
    $latestServiceTypes = latestServiceTypes('service-type');
?>
<?php if($latestServiceTypes): ?>
    <section class="our-services pt-3 pb-2">
        <div class="container">
            <div class="text-center">
            <h2 class="lead font-700 text-tertiary title-center mb-5">Service Types</h2>
            </div>
            <div class="mt-5 row our-service-list">
                <?php $__currentLoopData = $latestServiceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 text-center block mb-3" data-aos="fade-in" data-aos-duration="1500">
                        <div class="card h-100 transition">
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1 lead">
                                    <?php echo e($service->title); ?>

                                </div>
                                <div class="flex-grow-1 lead">
                                    <?php echo e($service->short_description); ?>

                                </div>
                                <div class="text-center">
                                    <a class="btn btn-default d-inline-block font-400" href="<?php echo e(url('services/'. $service->slug)); ?>">
                                        <span class="material-symbols-outlined">
                                            add
                                        </span>
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\service-types.blade.php ENDPATH**/ ?>