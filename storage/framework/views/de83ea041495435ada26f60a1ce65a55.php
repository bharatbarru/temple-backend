<section class="queries pb-0">
    <div class="container">
        <div class="card rounded-0 bg-tertiary  p-5">
            <div class="row  justify-content-between position-relative">
                <div class="col-md-6 block text-light">
                    <img src="<?php echo e(asset('assets/1.svg')); ?>" class="queries-img" alt="queries img" data-aos="zoom-in"/>
                    <div class="inner">
                        <div class="section-title  text-light title-left">
                            <h2><?php echo applicationSettings('queries-title'); ?></h2>
                        </div>
                        <p class="h5 font-400">
                            <?php echo applicationSettings('queries-description'); ?>

                        </p>
                        <p class="h5"><?php echo applicationSettings('queries-booking-title'); ?></p>
                        <a class="d-block" href="tel:<?php echo applicationSettings('primary-phone-number'); ?>"><?php echo applicationSettings('primary-phone-number'); ?></a>
                        <a class="d-block" href="tel:<?php echo applicationSettings('primary-phone-number'); ?>"><?php echo applicationSettings('primary-email'); ?></a>
                    </div>
                </div>
                <div class="col-md-6 form">
                    <div class="card card-body text-dark">
                        <h4>Got any queries?</h4>
                        <p class="sub-title font-400">Drop us a message and we’ll get back</p>
                        <form action="<?php echo e(url('contact-form-submission')); ?>" method="POST" id="contact-form">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <?php echo view('honeypot::honeypotFormFields'); ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fulltName">Name</label>
                                        <input name="name" type="text" class="form-control" id="fullName"
                                            placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Contact </label>
                                        <input name="phone" type="tel" class="form-control" id="phoneNumber"
                                            placeholder="+91 999 999 9999" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="email" class="form-control" id="email"
                                            placeholder="yourname@mail.com" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Message </label>
                                        <textarea class="form-control" name="message" id="message" rows="5" placeholder="Enter message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <div class="our-captcha">
                                    <div class="g-recaptcha" data-callback="imNotARobot"
                                        data-sitekey="6LcCslYqAAAAAC3oPw2Lz-QPQoiZRDrdnfBoSa8H"></div>
                                    </div>
                                    <div id="captchaerrors"></div>
                                    <button type="submit" class="btn btn-primary w-100" value="Send Message"
                                        id="contact_btn">
                                        <span>Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?php echo $__env->make('pages.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\get-queries.blade.php ENDPATH**/ ?>