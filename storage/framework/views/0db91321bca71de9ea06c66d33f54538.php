

<section class="our-products-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title  mb-5">Special Menu </h2>
        </div>
        <div class="products-list row">
            <?php $__currentLoopData = $specialProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 mb-3">
                    <a href="<?php echo e(url('/menu')); ?>" class="card text-center h-100">
                        <div class="card-body">
                            <figure class="circle-thumnail">


                                <?php if($product->image): ?>
                                <img src="<?php echo e(asset(PRODUCT_IMAGE_PATH . $product->image)); ?>" alt="<?php echo e($product->title); ?>"
                                class="object-fit-cover object-fit-center-postion w-100 h-100" />
                                <?php else: ?>
                                <img src="<?php echo e(asset('assets/no-image-aval.webp')); ?>" alt="<?php echo e($product->title); ?>"
                                class="object-fit-cover object-fit-center-postion w-100 h-100" /> 
                                <?php endif; ?>

                               




                            </figure>
                            <h4 class="font-700"> <?php echo e($product->title); ?></h4>
                            <p class="h5 font-700 mt-4 mb-4 text-primary"> <?php echo e(formatAmount($product->price)); ?> </p>
                            <span class="btn btn-primary left-ani-btn">Order Now</span>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-product.blade.php ENDPATH**/ ?>