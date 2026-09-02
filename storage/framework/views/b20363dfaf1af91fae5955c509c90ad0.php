<?php $__env->startSection('content'); ?>




<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-left">
                <div class="card shadow">
                    <div class="card-body">
                        <figure class="pic m-0 mb-3">
                            <img class="w-100" src="<?php echo e(asset(NEWS_IMAGE_PATH . $news->image)); ?>"
                                alt="<?php echo e($news->title); ?>">
                        </figure>
                        <h1><?php echo e($news->title); ?></h1>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="mr-2">
                                <span> <i class="material-symbols-outlined custom-icon">
                                        calendar_month
                                    </i> <?php echo e(date('M d, Y', strtotime($news->date))); ?></span>
                            </div>
                            <div class="text-small d-flex">
                                <span class="text-muted">
                                    <i class="material-symbols-outlined custom-icon">
                                        lan
                                    </i>
                                    <?php echo e($news->newsCategory->name); ?></span>
                            </div>
                        </div>
                        <div class="description"> <?php echo $news->description; ?></div>
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
                                <?php $__currentLoopData = $newsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item"><a href="<?php echo e(url('news/' . $category->name)); ?>"><span
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\news-details.blade.php ENDPATH**/ ?>