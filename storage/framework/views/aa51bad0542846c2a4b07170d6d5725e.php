<?php
    $ourBrands = getClienteleCategory('get-why-choose-us');
?>
<?php if($ourBrands): ?>
    <section class="our-brands text-center">
        <i class="flaticon-fast-delivery"></i>
        <img class="brand-left"  src="<?php echo e(asset("assets/our-brand-1.svg")); ?>" alt="Our Brand 1"   data-aos="zoom-out-up" data-aos-duration="1000"/>
        <img class="brand-right"  src="<?php echo e(asset("assets/our-brand-2.svg")); ?>" alt="Our Brand 2"  data-aos="zoom-out-up"  data-aos-duration="1000"/>
        <div class="container">
          
<figure class="m-0 section-img"><img src="<?php echo e(asset('assets/frock.svg')); ?>" alt="our brands"/></figure>

                <h2 class="section-title title-center  text-center"> <?php echo e($ourBrands->display_name); ?></h2>
                <p class="lead font-500"><?php echo $ourBrands->tagline; ?></p>
            
            <div class="five-items-slider our-brands-list mt-5">
                <?php $__currentLoopData = $ourBrands->clienteles->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($ourBrand->publish == 1): ?>
                        <div class="item">
                            <figure class="m-0">
                                
                                
                                <img src="<?php echo e(asset(CLIENTELE_IMAGE_PATH . $ourBrand->image)); ?>"
                                    alt="<?php echo e($ourBrand->image_alt_text); ?>">
                                
                                </figure>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
<?php endif; ?>
</section>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\brands.blade.php ENDPATH**/ ?>