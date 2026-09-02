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
    
    <section class="bg-dark text-light header-inner p-0 jarallax o-hidden inner-banner" data-overlay data-jarallax
        data-speed="0.2">
        <?php if($page->banner_image != ''): ?>
            <img src="<?php echo e(asset('images/inner-pages/' . $page->banner_image)); ?>" alt="<?php echo e($page->title); ?> "
                class="jarallax-img opacity-30" />
        <?php else: ?>
            <img src="<?php echo e(asset('images/commn-innerbanner.jpeg')); ?>" alt="<?php echo e($page->title); ?> "
                class="jarallax-img opacity-30">
        <?php endif; ?>
        <div class="container layer-2 ">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(url('/')); ?>">Home</a>
                    </li>
                    <?php if($page->parentName): ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(url('/' . $page->parentName->slug)); ?>"><?php echo e($page->parentName->title); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e($page->title); ?></li>
                </ol>
            </nav>
            <h1 class="display-1"><?php echo e($page->banner_title != '' ? $page->banner_title : $page->title); ?></h1>
        </div>
    </section>
    
    <section class="testimonial-page">
        <div class="container">
            <div class="inner-page-title">
                <h2 class="text-primary h1"><?php echo $page->banner_tagline; ?></h2>
                <p><?php echo $page->short_description; ?></p>
            </div>
            <?php if($testimonials->count() > 0): ?>
                <div class="row justify-content-center">
                    <div class="col-xl-11">
                        <div class="row">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-12 mb-3 " >
                                    <div class="card card-body shadow">
                                        <div class="row">
                                    <?php if($testimonial->image != ''): ?>
                                        <figure>
                                            <img src="<?php echo e(asset(TESTIMONIAL_IMAGE_PATH . $testimonial->image)); ?>"
                                                alt="<?php echo e($testimonial->name); ?>  " class="avatar mr-2">
                                        </figure>
                                    <?php endif; ?>
                                        <div class="col">
                                        <h4 class="mb-2"><?php echo e($testimonial->name); ?>

                                            <span><?php echo e($testimonial->designation); ?></span></h4>
                                        <?php echo $testimonial->description; ?>

                                    </div>
                                </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <ul class="pagination pagination-lg justify-content-center">
                    <?php echo e($testimonials->appends(request()->query())->links()); ?>

                </ul>
            <?php else: ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No Posts Found.
                </div>
            <?php endif; ?>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\testimonials.blade.php ENDPATH**/ ?>