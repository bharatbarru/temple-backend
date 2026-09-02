<footer class="bg-dark  pb-0 text-light">
    <div class="footer-pics">

        <img alt="<?php echo e(applicationSettingsAltText('footer-left-image')); ?>"
        src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('footer-left-image'))); ?>" class="footer-left-pic an-move-down"   />

        <img alt="<?php echo e(applicationSettingsAltText('footer-right-image')); ?>"
        src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('footer-right-image'))); ?>"  class="footer-right-pic an-move-down"  />

    
        
    </div>
    <div class="container">

<div class="row">
    <div class="col-md-3 footer-logo-section">
        <a class="footer-logo" href="<?php echo e(url('/')); ?>">
            <img class="img-fluid" alt="<?php echo e(applicationSettingsAltText('footer-logo')); ?>"
                src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('footer-logo'))); ?>" />
        </a>
        <div class="mt-2 font-14">
            <?php echo applicationSettings('footer-text'); ?>

        </div>
    </div>
    <div class="col-md-3 quick-links">
        <div class="inner ml-3 font-14">
        <h4 class="border-bottom pb-2">Quick Links</h4>
        <?php echo applicationSettings('footer-links'); ?>

        </div>
    </div>
    <div class="col-md-3 footer-content">
        <div class="inner ml-3 font-14">
        <h4 class="border-bottom pb-2">Our Timings</h4>
        <?php echo applicationSettings('timings'); ?>

        </div>
    </div>
    <div class="col-md-3 footer-content">
        <div class="inner ml-3">
        <h4 class="border-bottom pb-2">Contact us</h4>
        <ul class="footer-content-lists">
            <li> <a href="<?php echo applicationSettings('location-url'); ?>"><i class="flaticon-placeholder"></i>
                    <?php echo applicationSettings('address'); ?></a></li>
            <li> <a href="tel:<?php echo applicationSettings('primary-phone-number'); ?>"><i class="flaticon-telephone"></i>
                    <?php echo applicationSettings('primary-phone-number'); ?> (Call/Text)</a></li>
            <li>  <a href="tel:<?php echo applicationSettings('secondary-phone-number'); ?>"><i class="flaticon-telephone"></i>
                <?php echo applicationSettings('secondary-phone-number'); ?> ( Landline)</a></li>
            <li> <a href="mailto:<?php echo applicationSettings('primary-email'); ?>"><i class="flaticon-email-1"></i>
                    <?php echo applicationSettings('primary-email'); ?></a></li>
        </ul>
        </div>
    </div>
</div>



       
      
        <hr class="mt-5" />
        <div class="copy-rights font-14 pb-3">
            <div class="container">
                <div class="row  align-items-center justify-content-center">
                    <div class="col col-md-auto text-center pl-0">
                        Copyright <?php echo e(now()->year); ?> <?php echo applicationSettings('copyright-text'); ?>

                    </div>
                    <div class="col text-right"> Designed by: <img class="f9tech" src="<?php echo e(asset('assets/f9tech.png')); ?>"
                            alt="F9tech" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\footer.blade.php ENDPATH**/ ?>