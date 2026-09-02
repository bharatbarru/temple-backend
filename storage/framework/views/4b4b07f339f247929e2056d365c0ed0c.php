<?php $__env->startSection('title'); ?>
    <?php echo e($products->title ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seotitle'); ?>
    <?php echo e($products->seo_title ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seodescription'); ?>
    <?php echo e($products->seo_description ?? null); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seokeywords'); ?>
    <?php echo e($products->seo_keywords ?? null); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    
    <section class="bg-dark text-light header-inner p-0  inner-banner">
        <?php if(applicationSettings('product-details-image')): ?>
            <figure class="m-0">
                <img alt="<?php echo e(applicationSettingsAltText('product-details-image')); ?>"
                src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('product-details-image'))); ?>" class="w-100" />
            </figure>
        <?php else: ?>
            <figure class="m-0">
                <img src="<?php echo e(asset('assets/inner-banner.webp')); ?>" alt="OUR MENU" class="w-100">
            </figure>
        <?php endif; ?>
        <div class="inner-text text-center">
            <div class="container">
                <h1 class="display-2">OUR MENU</h1>
            </div>
        </div>
    </section>
    
    <section class="product-details">
        <div class="container">

<div class="row align-items-center">
    <div class="col-md-6 details-pic">
        <figure><img src="<?php echo e(asset(PRODUCT_IMAGE_PATH . $product->image)); ?>"
            class="w-100">
          
            
          </figure>
</div>
    
    <div class="col-md-6 details-content">
        <div class="inner-text">

            <h2 class="h1"><?php echo e($product->title); ?></h1>
                <div class="description lead"><?php echo $product->description; ?></div>

        </div>


    </div>
</div>


        
        </div>
    </section>
    
    <?php if($faqCategory): ?>
        <?php echo $__env->make('common.faqs', ['faqs' => $faqCategory->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\product-detail.blade.php ENDPATH**/ ?>