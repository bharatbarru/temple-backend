<?php $__env->startSection('content'); ?>
    
    <section class="bg-dark text-light header-inner p-0 jarallax o-hidden" data-overlay data-jarallax data-speed="0.2">
        <img src="<?php echo e(asset('frontend/img/inner-1.jpg')); ?>" alt="Image" class="jarallax-img opacity-30">
        <div class="container py-0 layer-2">
            <div class="row my-4 my-md-6" data-aos="fade-up">
                <div class="col-lg-9 col-xl-8">
                    <h1 class="display-4">Search Results</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(url('/')); ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    

    <?php if($products->count() > 0 || $blogPosts->count() > 0): ?>
        <section class="pt-5 products-section">
            <div class="container">
                <?php if($products->count() > 0 && $blogPosts->count() > 0): ?>
                <div class="row justify-content-center mb-4">
                    <div class="col col-md-auto">
                        <ul data-isotope-filters data-isotope-id="searchResults" class="nav mb-3">
                            <li class="nav-item">
                                <a href="#" class="nav-link active" data-filter="*">All</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-filter="products">Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-filter="blog">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($products->count() > 0): ?>
                    <div class="row" data-isotope-collection data-isotope-id="searchResults">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 mb-4"
                            data-isotope-item data-category="products">
                                <div class="card">
                                    <a href="<?php echo e(url('products/' . $product->slug)); ?>">
                                    <figure class="mb-0"><img src="<?php echo e(asset(PRODUCT_IMAGE_PATH . $product->image)); ?>"
                                        alt="<?php echo e($product->title); ?>" class="card-img-top"></figure>
                                    </a>
                                    <div class="card-body align-items-start">
                                        <h6 class="mb-1 primary-clr">
                                            <a href="<?php echo e(url('products/' . $product->slug)); ?>"><?php echo e($product->title); ?></a>
                                        </h6>
                                        <p>
                                            <?php echo \Illuminate\Support\Str::limit(strip_tags($product->description), 80, '...'); ?>

                                        </p>
                                        <a href="<?php echo e(url('products/' . $product->slug)); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <?php if($blogPosts->count() > 0): ?>
                    <div class="row" data-isotope-collection data-isotope-id="searchResults">
                        <?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 mb-4"
                            data-isotope-item data-category="blog">
                                <div class="card">
                                    <a href="<?php echo e(url('blog/' . $blogPost->slug)); ?>">
                                    <figure class="mb-0"><img src="<?php echo e(asset(BLOG_POST_IMAGE_PATH . $blogPost->image)); ?>"
                                        alt="<?php echo e($blogPost->title); ?>" class="card-img-top"></figure>
                                    </a>
                                    <div class="card-body align-items-start">
                                        <h6 class="mb-1 primary-clr">
                                            <a href="<?php echo e(url('blog/' . $blogPost->slug)); ?>"><?php echo e($blogPost->title); ?></a>
                                        </h6>
                                        <p>
                                            <?php echo \Illuminate\Support\Str::limit(strip_tags($blogPost->description), 150, '...'); ?>

                                        </p>
                                        <a href="<?php echo e(url('blog/' . $blogPost->slug)); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </section>
    <?php else: ?>
        <section class="pt-5 products-section">
            <h3 class="text-center">No Search Results Found</h3>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\search-results.blade.php ENDPATH**/ ?>