<?php
    $corporateValues = getClienteleCategory('corporate-values');
?>
<?php if($corporateValues): ?>
    <section class="corporate-section text-center">

        <figure class="value-pic m-0" data-aos="zoom-in" data-aos-duration="1000"><img src="<?php echo e(asset('assets/values-pic.svg')); ?>" alt="Corporate Values"/></figure>

        <div class="container-fluid">
            <h2 class="section-title  title-center"><?php echo e($corporateValues->display_name); ?></h2>
          
          <p class="lead font-500 mb-5">  <?php echo $corporateValues->tagline; ?></p>

            <div class="row mt-5">

            <?php $__currentLoopData = $corporateValues->clienteles->sortBy('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $corporateValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($corporateValue->publish == 1): ?>
            <div class="col  mb-3" data-aos="zoom-in-up" data-aos-duration="1000">
                <div class="item card card-body h-100 ">
                    <figure class="m-auto  avatar avatar-xlg card">
                        
                        
                        <img src="<?php echo e(asset(CLIENTELE_IMAGE_PATH . $corporateValue->image)); ?>"
                            alt="<?php echo e($corporateValue->image_alt_text); ?>">
                        
                        </figure>
                        <h5 class="mt-3"><?php echo e($corporateValue->title); ?></h5>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>



        </div>
    </section>
<?php endif; ?>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\corporate-values.blade.php ENDPATH**/ ?>