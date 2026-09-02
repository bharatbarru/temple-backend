<?php
    $ourLocations = getServiceCategory('locations');
?>
<?php if($ourLocations): ?>

<?php if($ourLocations->display_name || $ourLocations->tagline ): ?>
<div class=" text-center">
    <h2 class="font-color section-title title-center"><?php echo e($ourLocations->display_name); ?></h2>
    <p class="font-color"><?php echo $ourLocations->tagline; ?></p>
</div>
<?php endif; ?>




            <div class="row mt-5">
                <?php $__currentLoopData = $ourLocations->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-3">
                        <div class="card card-body bg-tertiary h-100 text-light pb-0">
                            <div class="text-center">
                                <div class="badge badge-top badge-primary "><span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex w-100 my-3 border-bottom pb-1">
                                <div class="icon">
                                    <span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                </div>
                                <div>
                                    <h4><?php echo e($ourLocation->sub_title); ?></h4>
                                    <?php echo $ourLocation->short_description; ?>

                                </div>
                            </div>
                            <?php if($ourLocation->video_url): ?>
                            <div class="d-flex w-100 my-1 border-bottom pb-3 align-items-center">
                                <div class="icon">
                                    <span class="material-symbols-outlined">
                                        email
                                    </span>
                                </div>
                                <div>
                                    <a href="tel:<?php echo e($ourLocation->video_url); ?>" class="h6"><?php echo e($ourLocation->video_url); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="d-flex w-100 my-3 border-bottom pb-3 align-items-center">
                                <div class="icon">
                                    <span class="material-symbols-outlined">
                                        phone
                                    </span>
                                </div>
                                <div>
                                    <a href="mailto:<?php echo e($ourLocation->icon); ?>" class="h5"><?php echo e($ourLocation->icon); ?></a>
                                </div>
                            </div>

                              <?php if($ourLocation->url): ?>
                            <a href="<?php echo e($ourLocation->custom_url); ?>" class="btn btn-outline-white text-light" <?php if($ourLocation->new_window == 'yes'): ?> target="_blank" <?php endif; ?> >
                                Get Location
                            </a>
                            <?php endif; ?>

                            <?php if($ourLocation->description): ?>
                            <div class="map mt-3">
                                <?php echo $ourLocation->description; ?>

                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
      
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-locations.blade.php ENDPATH**/ ?>