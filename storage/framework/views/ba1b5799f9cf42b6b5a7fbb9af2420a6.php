<?php $__env->startSection('title'); ?>
    <?php echo e($page->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seotitle'); ?>
    <?php echo e($page->seo_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seodescription'); ?>
    <?php echo e($page->seo_description); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seokeywords'); ?>
    <?php echo e($page->seo_keywords); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageclassname'); ?>
    contact-main-page
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
                <h1 class="display-2"><?php echo e($page->banner_title != '' ? $page->banner_title : $page->title); ?></h1>
            </div>
        </div>
    </section>
    
    <section class="contact-page">
        <div class="container">
      
            <div class="row  justify-content-between contact-addres-left">
                <div class="col-md-6 mob-order-2">
                    <div class="row text-center">
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-telephone"></i></div>
                                <h4 class="font-700">Phone Number</h4>
                                <a href="tel:<?php echo applicationSettings('primary-phone-number'); ?>">
                                    <?php echo applicationSettings('primary-phone-number'); ?> (Call/Text)</a>
                                <a href="tel:<?php echo applicationSettings('secondary-phone-number'); ?>">
                                    <?php echo applicationSettings('secondary-phone-number'); ?> ( Landline)</a>
                            </div>
                        </div>
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-email-1"></i></div>
                                <h4 class="font-700">Email Address</h4>
                                <a href="mailto:<?php echo applicationSettings('primary-email'); ?>">
                                    <?php echo applicationSettings('primary-email'); ?></a>
                                <a href="mailto:<?php echo applicationSettings('secondary-email'); ?>">
                                    <?php echo applicationSettings('secondary-email'); ?></a>
                            </div>
                        </div>
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-placeholder"></i></div>
                                <h4 class="font-700">Location</h4>
                                <a href="<?php echo applicationSettings('location-url'); ?>">
                                    <?php echo applicationSettings('address'); ?></a>
                            </div>
                        </div>
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-clock-1"></i></div>
                                <h4 class="font-700">Open & Closing</h4>
                                <div class="text-time">
                                    <?php echo applicationSettings('open-closing'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mob-order-1">

                    <?php if(isset($page) && $page->banner_tagline != ''): ?>
                    <div class=" mb-1">
                        <h2 class="h1"> <?php echo $page->banner_tagline; ?> </h2>
                    </div>
                    <hr/>
                    <?php endif; ?>

                    <form action="<?php echo e(url('contact-form-submission')); ?>" method="POST" id="contact-form">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <?php echo view('honeypot::honeypotFormFields'); ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Your Name *</label>
                                    <input name="name" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please type your name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input name="email" type="email" placeholder="yourname@mail.com"
                                        class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input name="phone" type="tel" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Message:</label>
                                    <textarea class="form-control" name="message" rows="5" placeholder="How can we help?"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                
                                <div class="our-captcha">
                                <div class="g-recaptcha" data-callback="imNotARobot"
                                    data-sitekey="6LcCslYqAAAAAC3oPw2Lz-QPQoiZRDrdnfBoSa8H"></div>
                                <div id="captchaerrors"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-none alert alert-success" role="alert" data-success-message="">
                                        Thanks, a member of our team will be in touch shortly.
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Sending"
                                        id="contact_btn">
                                        <img class="icon" src="" alt="loading icon" data-inject-svg="">
                                        <span>Send Enquiry</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make('pages.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="p-0 location-iframe">
        <?php echo applicationSettings('location-iframe'); ?>

    </section>
    <?php if($faqCategory): ?>
        <?php echo $__env->make('common.faqs', ['faqs' => $faqCategory->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\contact.blade.php ENDPATH**/ ?>