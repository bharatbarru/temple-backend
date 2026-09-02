<?php $__currentLoopData = $teamCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $teamsInCategory = $teams->where('team_categories_id', $categories->id);
    ?>
    <?php if($teamsInCategory->isNotEmpty()): ?>
        <section class="dotors-team">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <span class="small-title"><?php echo applicationSettings('our-dentist-content-sub-title'); ?></span>
                        <h2 class="h1"><?php echo applicationSettings('our-dentist-content-title'); ?></h2>
                        <?php echo applicationSettings('our-dentist-content-description'); ?>

                        <a href="<?php echo e(applicationSettings('our-dentist-content-button-url')); ?>"
                            class="btn btn-primary"><?php echo applicationSettings('our-dentist-content-button-text'); ?></a>
                    </div>
                    <div class="col-md-8">
                        <div class="row ">
                            <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($categories->id == $team->team_categories_id): ?>
                                    <div class="col-md-4 mb-5 aos-init aos-animate" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <div class="card card-lg card-body align-items-center border-0 p-0">
                                            <?php if($team->image != ''): ?>
                                                <img src="<?php echo e(asset(TEAM_IMAGE_PATH . $team->image)); ?>"
                                                    alt="<?php echo e($team->name); ?> Image " class="avatar avatar-xlg mb-3">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('images/no-image.jpg')); ?>" alt="<?php echo e($team->name); ?>"
                                                    class="avatar avatar-xlg mb-3" />
                                            <?php endif; ?>
                                            <p class="mb-0 h3"><?php echo e($team->name); ?></p>
                                            <span><?php echo e($team->designation); ?></span>
                                            <a class="full-link" style="font-size: 0" href="<?php echo e(url('our-dentists/' . $team->slug)); ?>" >View More</a>                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!-- end of team -->
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\dentists-team.blade.php ENDPATH**/ ?>