<?php $__env->startSection('title'); ?>
    <?php echo e($blogPost->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seotitle'); ?>
    <?php echo e($blogPost->seo_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seodescription'); ?>
    <?php echo e($blogPost->seo_description); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seokeywords'); ?>
    <?php echo e($blogPost->seo_keywords); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <section class="bg-dark text-light header-inner p-0  inner-banner">
        <?php if(applicationSettings('blog-banner')): ?>
            <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('blog-banner'))); ?>"
                alt="<?php echo e(applicationSettingsAltText('blog-banner')); ?>" class="w-100">
        <?php else: ?>
            <figure class="m-0">
                <img src="<?php echo e(asset('assets/inner-banner.webp')); ?>" alt="<?php echo e($blogPost->title); ?>" class="w-100">
            </figure>
        <?php endif; ?>
        <div class="inner-text text-center">
            <div class="container">
                
                <div class="display-2">Blog Details</div>
            </div>
        </div>
    </section>
    
    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-left">
                    <div class="card shadow">
                        <div class="card-body">
                            <figure class="pic m-0 mb-3"> <img class="w-100"
                                    src="<?php echo e(asset(BLOG_POST_IMAGE_PATH . $blogPost->image)); ?>"
                                    alt="<?php echo e($blogPost->title); ?>"></figure>
                            <h1><?php echo e($blogPost->title); ?></h1>
                            <div class="d-flex justify-content-between mb-3">
                                <div class="mr-2">
                                    <span> <i class="material-symbols-outlined custom-icon">
                                            calendar_month
                                        </i> <?php echo e(date('M d, Y', strtotime($blogPost->created_at))); ?></span>
                                </div>
                                <div class="text-small d-flex">
                                    <span class="text-muted">
                                        <i class="material-symbols-outlined custom-icon">
                                            lan
                                        </i>
                                        <?php echo e($blogPost->blogCategory->name); ?></span>
                                </div>
                            </div>
                            <div class="description"> <?php echo $blogPost->description; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar sticky-sidebar ">
                        <!--widget tags -->
                        <div class="widget  widget-tags">
                            <h4 class="widget-title">Categories</h4>
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item"><a href="<?php echo e(url('blogs/' . $category->name)); ?>"><span
                                                    class="material-symbols-outlined custom-icon">
                                                    lan
                                                </span>
                                                <?php echo e($category->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <!--end: widget tags -->
                    </div>
                </div>
            </div>
    </section>
    <?php if($faqCategory): ?>
        <?php echo $__env->make('common.faqs', ['faqs' => $faqCategory->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\blog-details.blade.php ENDPATH**/ ?>