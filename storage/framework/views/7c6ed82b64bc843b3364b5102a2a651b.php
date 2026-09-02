<section class="welcome-block pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-4 welcome-block-left">
                <?php if(applicationSettings('special-block1-tagline') || applicationSettings('special-block1-title') || applicationSettings('special-block1-free-text')): ?>
                    <div class="card card-body text-center bg-dark-green text-light mr-5 pb-0">
                        <p><?php echo applicationSettings('special-block1-tagline'); ?></p>
                        <h4><?php echo applicationSettings('special-block1-title'); ?></h4>
                        <?php if(applicationSettings('special-block1-image')): ?>
                            <figure class="m-0">
                                <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('special-block1-image'))); ?>"
                                    alt="<?php echo e(applicationSettingsAltText('special-block1-image')); ?>" class="img-fluid">
                                <figcaption><span><?php echo applicationSettings('special-block1-free-text'); ?></span></figcaption>
                            </figure>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <?php if(applicationSettings('special-block2-image') || applicationSettings('special-block2-title') || applicationSettings('special-block2-content1') || applicationSettings('special-block2-content2')): ?>
                            <a href="#"
                                class="card h-100 row no-gutters align-items-center bg-primary text-light custom-special-blocks mr-2 mb-0">
                                <div class="row h-100">
                                    <div class="col-md-5">
                                        <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('special-block2-image'))); ?>"
                                            alt="<?php echo e(applicationSettingsAltText('special-block2-image')); ?>"
                                            class="card-img-top w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body d-flex flex-column justify-content-between col-auto px-2 ">
                                            <div>
                                                <div class="h3"><?php echo applicationSettings('special-block2-title'); ?></div>
                                                <div class="h4"><?php echo applicationSettings('special-block2-content1'); ?></div>
                                                <div class="h4"><?php echo applicationSettings('special-block2-content2'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if(applicationSettings('special-block3-image') || applicationSettings('special-block3-title') || applicationSettings('special-block3-content1') || applicationSettings('special-block3-content2')): ?>
                            <a href="#"
                                class="card row no-gutters align-items-center bg-primary text-light custom-special-blocks ml-2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('special-block3-image'))); ?>"
                                            alt="<?php echo e(applicationSettingsAltText('special-block3-image')); ?>"
                                            class="card-img-top w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body d-flex flex-column justify-content-between col-auto px-2 ">
                                            <div>
                                                <div class="h3"><?php echo applicationSettings('special-block3-title'); ?></div>
                                                <div class="h4"><?php echo applicationSettings('special-block3-content1'); ?></div>
                                                <div class="h4"><?php echo applicationSettings('special-block3-content2'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(applicationSettings('special-block4-image') || applicationSettings('special-block4-title') || applicationSettings('special-block4-discount') || applicationSettings('special-block4-button-url') || applicationSettings('special-block4-button-text')): ?>
                    <div class="card card-body mt-2 green-bg text-light">
                        <div class="row align-items-center justify-content-between text-center">
                            <div class="col">
                                <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('special-block4-image'))); ?>"
                                    alt="<?php echo e(applicationSettingsAltText('special-block4-image')); ?>" class="img-fluid">
                            </div>
                            <div class="col">
                                <p><?php echo applicationSettings('special-block4-title'); ?></p>
                                <div class="h4"><?php echo applicationSettings('special-block4-discount'); ?></div>
                            </div>
                            <div class="col">
                                <a href="<?php echo applicationSettings('special-block4-button-url'); ?>" class="btn btn-white btn-lg custom-button" target=""
                                    tabindex="0">
                                    <span class="span-text" data-text="Menu">
                                        <?php echo applicationSettings('special-block4-button-text'); ?>

                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if(applicationSettings('special-block5-image') || applicationSettings('special-block5-title') || applicationSettings('special-block5-discount') || applicationSettings('special-block4-button-url') || applicationSettings('special-block4-button-text')): ?>
            <div class="card card-body mt-2 text-light red-bg">
                <div class="row align-items-center justify-content-between text-center">
                    <div class="col"> 
                        <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('special-block5-image'))); ?>"
                            alt="<?php echo e(applicationSettingsAltText('special-block5-image')); ?>" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <p><?php echo applicationSettings('special-block5-title'); ?></p>
                        <div class="h4"><?php echo applicationSettings('special-block5-discount'); ?></div>
                    </div>
                    <div class="col">
                        <a href="<?php echo applicationSettings('special-block4-button-url'); ?>" class="btn btn-white btn-lg custom-button" target=""
                            tabindex="0">
                            <span class="span-text" data-text="Menu">
                                <?php echo applicationSettings('special-block4-button-text'); ?>

                            </span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\welcome-block.blade.php ENDPATH**/ ?>