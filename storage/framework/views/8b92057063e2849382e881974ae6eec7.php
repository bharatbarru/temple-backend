<?php $__env->startSection('content'); ?>
<section class="pt-5 order-online sign-login">
    <div class="container">
        <div class="row justify-content-center pt-6">
            <div class=" col-md-6">

                <div class="card card-body shadow">
                <div class="text-center ">
                    <h1 class="mb-1 h2 text-primary font-700">Sign Up or Login</h1>
                    <p>Sign Up or Login with your social account</p>
                </div>

                <hr class="mb-1">

                

                <div class="form-group text-center pt-3">
                    <?php echo $__env->make('customers-auth.social-login-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\customers-auth\login.blade.php ENDPATH**/ ?>