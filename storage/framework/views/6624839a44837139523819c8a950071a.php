<!-- Field Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('field_name', 'Field Name:', ['class' => 'span_required']); ?>

    <?php echo Form::text('field_name', null, ['class' => 'form-control', 'required', 'onkeyup' => 'convertToSlug()']); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-4 fixed_label readonly_input">
    <?php echo Form::label('slug', 'Slug:', ['class' => 'span_required']); ?>

    <?php echo Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'required', 'readonly']); ?>

</div>

<!-- Input Type Field -->
<div class="form-group select-area col-sm-4">
    <?php echo Form::label('input_type', 'Select Input Type:', ['class' => 'span_required']); ?>

    <?php echo Form::select('input_type', INPUT_TYPES, null, ['class' => 'form-control select2', 'id' => 'input_type', 'placeholder' => 'Select Input Type', 'required'],
    ); ?>

</div>

<!-- Options Field -->
<div class="form-group col-sm-4 options_block" style="display: none;">
    <?php echo Form::label('options', 'Options:', ['class' => 'span_required']); ?>

    <?php echo Form::textarea('options', null, ['class' => 'form-control', 'id' => 'options']); ?>

</div>

<!-- Category Id Field -->
<div class="form-group select-area col-sm-4">
    <?php echo Form::label('application_setting_category_id', 'Select Category:', ['class' => 'span_required']); ?>

    <?php echo Form::select('application_setting_category_id', $categories, null, ['class' => 'form-control select2', 'placeholder' => 'Select Category']); ?>

</div>

<!-- Type Field -->
<div class="form-group select-area col-sm-4">
    <?php echo Form::label('application_setting_type_id', 'Select Type:', ['class' => 'span_required']); ?>

    <?php echo Form::select('application_setting_type_id', $types, null, ['class' => 'form-control select2', 'placeholder' => 'Select Type', 'required']); ?>

</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'field_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        function checkInputType(type) {
            if (type == 'select' || type == 'radio' || type == 'checkbox') {
                $('.options_block').show();
                $('#options').attr('required', true);
            } else {
                $('.options_block').hide();
                $('#options').attr('required', false);
            }
        }
        checkInputType($("#input_type option:selected").val());
        $("#input_type").change(function() {
            checkInputType(this.value);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_settings\fields.blade.php ENDPATH**/ ?>