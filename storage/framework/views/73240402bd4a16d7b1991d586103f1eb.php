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
<?php $__env->startSection('pageclassname'); ?>
    order-pickup-page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($sliders->count() > 0): ?>
<section class="resturant-banner p-0">
    <img class="w-50 float-right" src="<?php echo e(asset('assets/bg.png')); ?>">
    <div class="clear"></div>
    <div class="home-slider">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item h-100">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-6">
                            <?php if($slider->title || $slider->tagline || $slider->button_name || $slider->button_url): ?>
                                <div class="banner-text ">
                                    <div class="banner-text-inner ">
                                        <h1 class="display-3 section-title w-bg">
                                            Order & Pickup

                                            
                                        </h1>
                                        <h3 class="lobster-regular h1"><span class="text-primary">
                                               
                                        Authentic Traditional  </span> South Indian,North Indian Dishes</h3>
                                        <p class="lead font-400">Discover the trendiest spot in Chicago Loop for mouthwatering, genuine Indian cuisine to-go.

                                        </p>

                                            <div class="buttons-block mt-5 ">
                                        
                                        <a href="tel:<?php echo applicationSettings('secondary-phone-number'); ?>" class="btn btn-white btn-lg custom-button btn-shadow" target="_blank" tabindex="0">
                                            Call Now
                                        </a>
                                            </div>


                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <figure class="m-0  rotate-pic an-move-down ">
                    <img class="img-fluid" src="<?php echo e(asset(SLIDER_IMAGE_PATH . $slider->image)); ?>"
                        alt="<?php echo e($slider->image_alt_text); ?>">
                </figure>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>




<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\order-pickup.blade.php ENDPATH**/ ?>