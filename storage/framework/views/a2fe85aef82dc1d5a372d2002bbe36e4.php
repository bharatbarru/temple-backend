<?php $__env->startSection('title'); ?>
    <?php echo e($service->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seotitle'); ?>
    <?php echo e($service->seo_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seodescription'); ?>
    <?php echo e($service->seo_description); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seokeywords'); ?>
    <?php echo e($service->seo_keywords); ?>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
    
      
      <section class="bg-dark text-light header-inner p-0  inner-banner">
        <?php if(applicationSettings('our-service-image')): ?>
            <figure class="m-0">
                <img alt="<?php echo e(applicationSettingsAltText('our-service-image')); ?>"
                src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('our-service-image'))); ?>" class="w-100" />
            </figure>
        <?php else: ?>
            <figure class="m-0">
                <img src="<?php echo e(asset('assets/inner-banner.webp')); ?>" alt="Our Service" class="w-100">
            </figure>
        <?php endif; ?>
        <div class="inner-text text-center">
            <div class="container">
                <h1 class="display-2">Our Service</h1>
            </div>
        </div>
    </section>
    
    
    
    <section class="service-details bg-tertiary">
        <div class="container">


            <div class="row">

                <div class="col-md-7 service-left">

<div class="inner">
    <?php if($service->image != ''): ?>
    <figure class="service-image m-0 mb-3">
        <img src="<?php echo e(asset(SERVICE_IMAGE_PATH . $service->image)); ?>" alt="<?php echo e($service->title); ?>" class="w-100">
    </figure>
<?php endif; ?>
<h2 class="text-light"><?php echo $service->title; ?></h2>
<div class="description text-light">


    <?php if($service->description != ''): ?>
<?php echo $service->description; ?>


<?php else: ?>

    <?php echo $service->short_description; ?>


    <?php endif; ?>

</div>
</div>


                </div>
                <div class="col-md-5 pl-5 service-right">
                    <div class="sticky-top">

                        <div class="card card-body mb-3">
                            <h4 class="section-title">Related Services</h4>
                            <?php
                            $ourServices = getServiceCategory('our-services');
                            ?>

<ul class="list-unstyled list-articles">
    <?php if($ourServices): ?>
                            <?php $__currentLoopData = $ourServices->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="row row-tight">

                                <?php if($ourService->image != ''): ?>
                                <a href="<?php echo e(url('services/' . $ourService->slug)); ?>" class="col-3 thumbnail1">
                                    <img class="rounded object-fit-cover" style="min-height: 70px" src="<?php echo e(asset(SERVICE_IMAGE_PATH . $ourService->image)); ?>" alt="<?php echo e($ourService->image_alt_text); ?>">
                                  </a>
                                  <?php endif; ?>
                             
                                <div class="col">
                                    <a href="<?php echo e(url('services/' . $ourService->slug)); ?>" class="col-3 thumbnail1">
                                    <h6 class="mb-1"><?php echo $ourService->title; ?></h6>
                                  </a>
                                 
                                </div>
                              </li>
 
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                  <?php endif; ?>
                      
                      </ul>
                    </div>

                    <?php if($service->gallery != ''): ?>
                    <div class="row service-gallery">
                        <?php $__currentLoopData = json_decode($service->gallery); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 block">
                                <figure>
                                    <img src="<?php echo e(asset(SERVICE_IMAGE_PATH . $gal->path)); ?>"
                                        alt="<?php echo e($gal->alt_text); ?>" class="card-img-top">
                                </figure>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                    </div>
                </div>

            </div>





       
            
         
         
        </div>
      
    </section>
 
    
    

    <?php echo $__env->make('pages.get-testimonials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\service-details.blade.php ENDPATH**/ ?>