<section class="home-about">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="section-title  mb-5"><?php echo applicationSettings('about-title'); ?></h2></div>
        <div class="row">
            <div class="col-md-6"><figure class="m-0">
                
                <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('about-image'))); ?>"
                alt="<?php echo e(applicationSettingsAltText('about-image')); ?>" class="w-100">
                
            </figure></div>
            <div class="col-md-6"><div class="inner"><?php echo applicationSettings('about-content'); ?></div></div></div>
    </div>
</section><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-about.blade.php ENDPATH**/ ?>