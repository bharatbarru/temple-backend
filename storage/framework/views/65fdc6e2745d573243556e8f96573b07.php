<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required', 'maxlength' => 255, 'onkeyup' => 'convertToSlug()']); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-4 disbaled_input">
    <?php echo Form::label('slug', 'Slug:', ['class' => 'span_required']); ?>

    <?php echo Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']); ?>

</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <?php echo Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($eventCategory) ? $eventCategory->image : null, 'path' => EVENT_CATEGORY_IMAGE_PATH], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\event_categories\fields.blade.php ENDPATH**/ ?>