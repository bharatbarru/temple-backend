<?php $__env->startSection('title'); ?>
    <?php echo e($page->title ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seotitle'); ?>
    <?php echo e($page->seo_title ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seodescription'); ?>
    <?php echo e($page->seo_description ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seokeywords'); ?>
    <?php echo e($page->seo_keywords ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageclassname'); ?>
    homepage
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
                                                <?php if($key == 0 && $slider->title): ?>
                                                    <h1 class="display-3 section-title w-bg">
                                                        <?php echo $slider->title; ?>

                                                    </h1>
                                                <?php elseif($slider->title): ?>
                                                    <h2 class="display-3 section-title w-bg">
                                                        <?php echo $slider->title; ?>

                                                    </h2>
                                                <?php endif; ?>
                                                <?php if($slider->tagline): ?>
                                                    <p class="lead font-400"><?php echo $slider->tagline; ?></p>
                                                <?php endif; ?>

                                                    <div class="buttons-block mt-5 ">
                                                <?php if($slider->button_name && $slider->button_url): ?>
                                                    <a href="<?php echo e($slider->button_url); ?>"
                                                        class="btn btn-secondary btn-lg custom-button btn-shadow"
                                                        target="<?php echo e($slider->new_window ? '_target' : ''); ?>">
                                                        <span class="span-text" data-text="<?php echo e($slider->button_name); ?>">
                                                        <?php echo e($slider->button_name); ?>

                                                        </span>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(url('/menu')); ?>" class="btn btn-white btn-lg custom-button btn-shadow" target="" tabindex="0">
                                                    <span class="span-text" data-text="Menu">
                                                    Menu
                                                </span>
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


<?php echo $__env->make('pages.welcome-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('pages.get-product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('pages.why-choose-us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('pages.get-about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('pages.get-our-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\index.blade.php ENDPATH**/ ?>