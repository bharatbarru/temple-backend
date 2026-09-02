<!-- Page Type Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('page_type', 'Page Type:'); ?>

    <?php echo Form::select('page_type', ['pages' => 'pages', 'blogs' => 'blogs', 'services' => 'services', 'products' => 'products'], null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Page Type',
        'required',
        'id' => 'page_type', // Add an ID to identify the element
    ]); ?>

</div>

<!-- Page Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('page_name', 'Page Name:'); ?>

    <?php echo Form::select('page_name[]',isset($faqCategory) ? getPageNames($faqCategory->page_type, null) : [], null, [
        'class' => 'form-control select2',
        'multiple',
        'required',
        'id' => 'page_name', // Add an ID to identify the element
    ]); ?>

</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Category Name:'); ?>

    <?php echo Form::text('name', null, [
        'class' => 'form-control',
        'required',
    ]); ?>

</div>
<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $(function() {
            $("#page_type").on("change", function() {
                var type = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(url('admin/get-page-names-list')); ?>",
                    data: {
                        type: type,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function (response) {
                        $("#page_name").find('option').remove();
                            $.each(response, function(key, value) {
                                $("#page_name").append(
                                    '<option value="' + key + '">' + value + '</option>'
                                );
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.error);
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\faq_categories\fields.blade.php ENDPATH**/ ?>