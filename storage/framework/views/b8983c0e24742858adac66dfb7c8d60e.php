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
<?php $__env->startSection('pageclassname'); ?>
    menu-main-page
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
                <h1 class="display-3"><?php echo e($page->banner_title != '' ? $page->banner_title : $page->title); ?></h1>
            </div>
        </div>
    </section>
    <div class="menu-positions-pics">
        <img alt="<?php echo e(applicationSettingsAltText('menu-left-image')); ?>"
            src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('menu-left-image'))); ?>"
            class="menu-left-pic an-move-down" />
        <img alt="<?php echo e(applicationSettingsAltText('menu-right-image')); ?>"
            src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('menu-right-image'))); ?>"
            class="menu-right-pic an-move-down" />
    </div>
    <div class="hide-mobile">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col">
                    <div class="product-cat sticky-top mb-3 align-items-center bg-tertiary">
                        <div class="tabs-container">
                            <!-- Left Arrow -->
                            <button class="scroll-arrow left-arrow" id="scroll-left">&lt;</button>
                            <!-- Nav Tabs -->
                            <ul class="nav nav-tabs tabs-scrollable" id="foodmenuTab" role="tablist">
                                <!-- First Tab for All Products -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-all" data-toggle="tab" href="#content-all" role="tab"
                                       aria-controls="content-all" aria-selected="true">All</a>
                                </li>
                                <!-- Dynamically generating tabs for each category -->
                                <?php $__currentLoopData = $productCategories->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-<?php echo e(Str::slug($productCategory->name)); ?>"
                                           data-toggle="tab" href="#content-<?php echo e(Str::slug($productCategory->name)); ?>" role="tab"
                                           aria-controls="content-<?php echo e(Str::slug($productCategory->name)); ?>" aria-selected="false">
                                            <?php echo e($productCategory->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <!-- Right Arrow -->
                            <button class="scroll-arrow right-arrow" id="scroll-right">&gt;</button>
                        </div>
                    </div>
                    
                    <!-- Tab panes -->
                    <div class="tab-content" id="foodmenuTabContent">
                        <!-- First Tab Pane for All Products -->
                        <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">
                            <div class="row" data-isotope-collection data-isotope-id="example-1">

                                <?php $__currentLoopData = $productCategories->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div data-isotope-item class="col-4">
                                    <div class="inner  p-2 h-100">
                                        <h5 class=" text-primary font-700 text-uppercase"> <?php echo e($productCategory->name); ?>

                                        </h5>
                                        <ul class="products-lists">
                                            <?php $__currentLoopData = $productCategory->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="#" class="d-block">
                                                        <div class="row justify-content-between align-items-center">
                                                            <h6 class="col-8 le">
                                                                <span><?php echo e($product->title); ?><span></span></span>
                                                            </h6>
                                                            <hr>
                                                            <p class="col-4 text-primary text-right font-700 font-14">
                                                                <span> <?php echo e(formatAmount($product->price)); ?> </span>
                                                            </p>
                                                        </div>
                                                        <div class="des font-14 font-400">
                                                            <?php echo e($product->short_description); ?>

                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                           
                              </div>
                            
                        </div>
                        <!-- Tab Panes for Each Category -->
                        <?php $__currentLoopData = $productCategories->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade" id="content-<?php echo e(Str::slug($productCategory->name)); ?>" role="tabpanel"
                                aria-labelledby="tab-<?php echo e(Str::slug($productCategory->name)); ?>">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 mb-3 menu-page-lists">
                                        <div class="inner shadow p-2">
                                            <h5 class=" text-primary font-700 text-uppercase"> <?php echo e($productCategory->name); ?>

                                            </h5>
                                            <ul class="products-lists">
                                                <?php $__currentLoopData = $productCategory->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="#" class="d-block">
                                                            <div class="row justify-content-between align-items-center">
                                                                <h6 class="col-8 le">
                                                                    <span><?php echo e($product->title); ?><span></span></span>
                                                                </h6>
                                                                <hr>
                                                                <p class="col-4 text-primary text-right font-700 font-14">
                                                                    <span> <?php echo e(formatAmount($product->price)); ?></span>
                                                                </p>
                                                            </div>
                                                            <div class="des font-14 font-400">
                                                                <?php echo e($product->short_description); ?>

                                                            </div>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="mobile-show show-mobile pt-0">
        <div class="container">
            <!-- Categories Dropdown -->
            <div class="cat mb-3">
                <h4 class="font-700">Select Categories</h4>
                <select id="category-select" class="form-control">
                    <option value="all">All Categories</option>
                    <?php $__currentLoopData = $productCategories->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($productCategory->id); ?>"><?php echo e($productCategory->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <!-- Products List -->
            <div class="products-list">
                <?php $__currentLoopData = $productCategories->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3 menu-page-lists product-category" data-category="<?php echo e($productCategory->id); ?>">
                        <div class="inner shadow p-2">
                            <h5 class="text-primary font-700 text-uppercase"> <?php echo e($productCategory->name); ?></h5>
                            <ul class="products-lists">
                                <?php $__currentLoopData = $productCategory->products->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(url('products/' . $product->slug)); ?>" class="d-block">
                                            <?php if($product->price != ''): ?>
                                                <div class="row justify-content-between align-items-center">
                                                    <h6 class="col-8 le"><span><?php echo $product->title; ?><span></h6>
                                                    <hr />
                                                    <p class="col-4 text-primary text-right font-700 font-14">
                                                        <span>
                                                            <?php echo e(formatAmount($product->price)); ?></span>
                                                    </p>
                                                </div>
                                            <?php else: ?>
                                                <h6><?php echo $product->title; ?></h6>
                                            <?php endif; ?>
                                            <div class="des font-14 font-400"> <?php echo $product->short_description; ?></div>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\product.blade.php ENDPATH**/ ?>