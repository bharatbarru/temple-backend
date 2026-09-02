<!-- Type Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('type', 'Type:'); ?>

    <?php echo Form::text('type', null, ['class' => 'form-control', 'required', 'onkeyup' => 'convertToSlug()']); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <?php echo Form::text('slug', null, ['class' => 'form-control', 'required', 'readonly']); ?>

</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_setting_types\fields.blade.php ENDPATH**/ ?>