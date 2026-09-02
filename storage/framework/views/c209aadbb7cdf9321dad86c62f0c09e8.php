<?php $__env->startSection('page_styles'); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#contact_btn").click(function(){
                var response = grecaptcha.getResponse();
                if(response != '') {
                    return true;
                }else{
                    event.preventDefault();
                    $('#contact-form').parsley().validate();
                    $("#captchaerrors").text("Invalid Captcha");
                    $("#captchaerrors").addClass("captchaError");
                    return false;
                }
            });
        });

        var imNotARobot = function() {
            var response = grecaptcha.getResponse();
            if(response != '') {
                $("#captchaerrors").text('');
                $("#captchaerrors").removeClass("captchaError");
            }
        };
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\recaptcha.blade.php ENDPATH**/ ?>