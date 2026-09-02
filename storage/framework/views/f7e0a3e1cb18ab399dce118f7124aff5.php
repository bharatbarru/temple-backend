<?php if(isset($page)): ?>
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
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <?php if(isset($page)): ?>
        
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
    <?php endif; ?>

    
    <section class="our-blog-post">
        <div class="container">
            <?php if(isset($page) && $page->banner_tagline != ''): ?>
            <div class="text-center mb-5">
                <h2 class="h1"> <?php echo $page->banner_tagline; ?></h2>
            </div>
            <?php endif; ?>
            <?php if($news->count() > 0): ?>
                <div class="row mb-4">
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4 d-flex ">
                            <div class="card">
                                <a href="<?php echo e(url('news/' . $news->slug)); ?>">
                                    <figure class="m-0"> <img src="<?php echo e(asset(NEWS_IMAGE_PATH . $news->image)); ?>" alt="Image"
                                            class="card-img-top"></figure>
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <div class="block">
                                        <div class="text-small d-flex date-col mb-2">
                                            <span > <i class="material-symbols-outlined custom-icon">
                                                calendar_month
                                            </i> <?php echo e(date('M d, Y', strtotime($news->date))); ?></span>
                                        </div>
                                     
                                    </div>
                                    <a href="<?php echo e(url('news/' . $news->slug)); ?>">
                                        <h4 class="font-color"><?php echo e($news->title); ?></h4>
                                    </a>
                                    <p class="flex-grow-1">
                                        <?php echo \Illuminate\Support\Str::limit(strip_tags($news->description), 150, '...'); ?>

                                    </p>
                                <a href="<?php echo e(url('news/' . $news->slug)); ?>" class="lead hover-arrow mt-5 d-inline-block">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <!-- end: Pagination -->
            <?php else: ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No Posts Found.
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php if(isset($faqCategory)): ?>
        <?php echo $__env->make('common.faqs', ['faqs' => $faqCategory->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\news.blade.php ENDPATH**/ ?>