<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        function convertToSlug() {
            var text = $("#<?php echo e($fieldName); ?>").val();
            var output = text.toLowerCase()
                        .replace(/ /g, '-')
                        .replace(/[^\w-]+/g, '');
            $("#slug").val(output);
        }
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\common\string-to-slug.blade.php ENDPATH**/ ?>