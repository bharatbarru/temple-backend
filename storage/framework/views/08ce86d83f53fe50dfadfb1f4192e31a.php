<?php $__env->startSection('title'); ?>
    <?php echo e($page->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seotitle'); ?>
    <?php echo e($page->seo_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seodescription'); ?>
    <?php echo e($page->seo_description); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seokeywords'); ?>
    <?php echo e($page->seo_keywords); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <section class="bg-dark text-light header-inner p-0  inner-banner">
        <?php if($page->banner_image != ''): ?>
            <figure class="m-0">
                <img src="<?php echo e(asset('images/inner-pages/' . $page->banner_image)); ?>" alt="<?php echo e($page->banner_image_alt_text); ?>"
                    class="w-100" />
            </figure>
        <?php else: ?>
            <figure class="m-0">
                <img src="<?php echo e(asset('assets/inner-banner.webp')); ?>" alt="<?php echo e($page->title); ?>" class="w-100">
            </figure>
        <?php endif; ?>
        <div class="inner-text text-center">
            <div class="container">
                <h1 class="display-2"><?php echo e($page->banner_title != '' ? $page->banner_title : $page->title); ?></h1>
            </div>
        </div>
    </section>
    
    <section class="our-team">
        <div class="container">
            <?php $__currentLoopData = $teamCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $teamsInCategory = $teams->where('team_categories_id', $categories->id);
                ?>
                <?php if($teamsInCategory->isNotEmpty()): ?>
                    <div class="team-list">
                        <div class="section-title text-center">
                            <h2 class="font-color"> <?php echo e($categories->name); ?></h2>
                        </div>
                        <div class="row mb-5">
                            <?php $__currentLoopData = $teams->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($categories->id == $team->team_categories_id || $team->publish == 1): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card card-icon-2  justify-content-center shadow-3d  text-center ">
                                            <figure class="m-0"> <img src="<?php echo e(asset(TEAM_IMAGE_PATH . $team->image)); ?>"
                                                    alt="<?php echo e($team->name); ?> Image " class="w-100"></figure>
                                            <div class="cards-inner p-2">
                                                <h5 class="mb-0 font-color"><?php echo e($team->name); ?></h5>
                                                <p><?php echo e($team->designation); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <!-- end of team -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\our-team.blade.php ENDPATH**/ ?>