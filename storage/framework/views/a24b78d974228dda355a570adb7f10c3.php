<section class="our-menu-section">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="section-title mb-5">From Our Menu</h2>
        </div>

        <!-- Desktop View -->
        <div class="hide-mobile">
            <?php if($productCategories->count() > 0): ?>
                <div class="row justify-content-center mt-5">
                    <div class="col">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-10">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="menuTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-all" data-toggle="tab" href="#content-all" 
                                           role="tab" aria-controls="content-all" aria-selected="true">
                                            All 
                                        </a>
                                    </li>
                                    <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-<?php echo e($productCategory->id); ?>" 
                                               data-toggle="tab" href="#content-<?php echo e($productCategory->id); ?>" 
                                               role="tab" aria-controls="content-<?php echo e($productCategory->id); ?>" 
                                               aria-selected="false">
                                                <?php echo e($productCategory->name); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="col text-right">
                                <a href="<?php echo e(url('/menu')); ?>" class="btn btn-white btn-lg custom-button" tabindex="0">
                                    <span class="span-text" data-text="Menu">Menu</span>
                                </a>
                            </div>
                        </div>
        
                        <!-- Tab panes -->
                        <div class="tab-content" id="menuTabContent">
                            <!-- All Categories Tab Content -->
                            <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">
                                <div class="row">
                                    <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $productCategory->products->where('special_product', 1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4 mb-3">
                                                <a href="<?php echo e(url('/menu')); ?>"  class="card text-center shadow h-100 mb-0">
                                                    <figure class="thumbnail m-0">
                                                        <?php if($product->image): ?>
                                                            <img src="<?php echo e(asset(PRODUCT_IMAGE_PATH . $product->image)); ?>" 
                                                                 alt="<?php echo e($product->title); ?>" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/no-image-aval.webp')); ?>" 
                                                                 alt="<?php echo e($product->title); ?>" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        <?php endif; ?>
                                                    </figure>
                                                    <div class="card-body align-items-start">
                                                        <div class="mb-1">
                                                            <h5 class="font-700"><?php echo e($product->title); ?></h5>
                                                        </div>
                                                        <div class="des mb-3">
                                                            <?php echo \Illuminate\Support\Str::limit(strip_tags($product->short_description), 80, '...'); ?>

                                                        </div>
                                                        <div class="h4"> <?php echo formatAmount($product->price); ?></div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
        
                            <!-- Individual Categories Tab Content -->
                            <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade" id="content-<?php echo e($productCategory->id); ?>" role="tabpanel" 
                                     aria-labelledby="tab-<?php echo e($productCategory->id); ?>">
                                    <div class="row">
                                        <?php $__currentLoopData = $productCategory->products->where('special_product', 1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4 mb-3">
                                                <a href="<?php echo e(url('/menu')); ?>"  class="card text-center shadow h-100 mb-0">
                                                    <figure class="thumbnail m-0">
                                                        <?php if($product->image): ?>
                                                            <img src="<?php echo e(asset(PRODUCT_IMAGE_PATH . $product->image)); ?>" 
                                                                 alt="<?php echo e($product->title); ?>" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/no-image-aval.webp')); ?>" 
                                                                 alt="<?php echo e($product->title); ?>" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        <?php endif; ?>
                                                    </figure>
                                                    <div class="card-body align-items-start">
                                                        <div class="mb-1">
                                                            <h5 class="font-700"><?php echo e($product->title); ?></h5>
                                                        </div>
                                                        <div class="des mb-3">
                                                            <?php echo \Illuminate\Support\Str::limit(strip_tags($product->short_description), 80, '...'); ?>

                                                        </div>
                                                        <div class="h4"> <?php echo formatAmount($product->price); ?></div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
        
                                    <!-- View More Button if there are more than 3 products -->
                                    <?php if($productCategory->products->where('special_product', 1)->count() > 3): ?>
                                        <div class="text-center mt-3">
                                            <a href="<?php echo e(url('/menu')); ?>" class="btn btn-white btn-lg custom-button">
                                                View More
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        

        <!-- Mobile View -->
        <div class="show-mobile">
            <?php if($productCategories->count() > 0): ?>
                <!-- Dropdown for Category Selection -->
                <select id="categoryFilter" class="form-control mb-3">
                    <option value="all">All</option>
                    <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($productCategory->id); ?>"><?php echo e($productCategory->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
        
                <!-- Product Categories and Products -->
                <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 product-category mb-3" id="category-<?php echo e($productCategory->id); ?>">
                        <?php $__currentLoopData = $productCategory->products->where('special_product', 1)->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('/menu')); ?>" class="card text-center shadow h-100 mb-0">
                                <figure class="thumbnail m-0">
                                    <img src="<?php echo e($product->image ? asset(PRODUCT_IMAGE_PATH . $product->image) : asset('assets/no-image-aval.webp')); ?>"
                                         alt="<?php echo e($product->title); ?>" class="w-100 h-100 object-fit-cover">
                                </figure>
                                <div class="card-body align-items-start">
                                    <div class="mb-1">
                                        <h5 class="font-700"><?php echo e($product->title); ?></h5>
                                    </div>
                                    <div class="des mb-3">
                                        <?php echo \Illuminate\Support\Str::limit(strip_tags($product->short_description), 80, '...'); ?>

                                    </div>
                                    <div class="h4"> 
                                        <?php echo formatAmount($product->price); ?>

                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                        <!-- View More Button if there are more than 6 products -->
                        <?php if($productCategory->products->where('special_product', 1)->count() > 6): ?>
                            <div class="text-center mt-3">
                                <a href="<?php echo e(url('/menu')); ?>" class="btn btn-white btn-lg custom-button">
                                    View More
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                <div class="text-center mt-5">
                    <!-- Menu Button -->
                    <a href="<?php echo e(url('/menu')); ?>" class="btn btn-white btn-lg custom-button" tabindex="0">
                        <span class="span-text" data-text="Menu">Menu</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
    </div>
</section>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-our-menu.blade.php ENDPATH**/ ?>