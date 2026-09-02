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



<?php
$ourServices = getServiceCategory('our-services');
?>
<?php if($ourServices): ?>
<section class="pt-5 services-page-section">
    <div class="container">
        <div class="our-services text-center ">
            <h2 class="h1"> <?php echo $page->banner_tagline; ?></h2>
            <div class="mt-5 row our-service-list">
                <?php $__currentLoopData = $ourServices->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-3 text-center block">
                   
                        <div class="card h-100">
                                
                            <div class="card-body d-flex flex-column">
                                <a href="<?php echo e(url('services/' . $ourService->slug)); ?>" class="thumbnail">
                                    <img class="w-100 h-100 object-fit-cover object-fit-center-postion" src="<?php echo e(asset(SERVICE_IMAGE_PATH . $ourService->image)); ?>" alt="<?php echo e($ourService->image_alt_text); ?>">
                                  </a>
                           
                              <a href="<?php echo e(url('services/' . $ourService->slug)); ?>">
                                <h5 class="font-700"><?php echo e($ourService->title); ?></h5>
                              </a>
                              <div class="flex-grow-1">
                                <?php echo $ourService->short_description; ?>

                              </div>
                             
                            </div>
                          </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
 

    
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\our-services.blade.php ENDPATH**/ ?>