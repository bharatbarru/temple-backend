<!-- Field Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('field_name', 'Field Name:'); ?>

    <p><?php echo e($applicationSetting->field_name); ?></p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <p><?php echo e($applicationSetting->slug); ?></p>
</div>

<!-- Input Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('input_type', 'Input Type:'); ?>

    <p><?php echo e($applicationSetting->input_type); ?></p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    <?php echo Form::label('value', 'Value:'); ?>

    <p><?php echo e($applicationSetting->value); ?></p>
</div>

<!-- Options Field -->
<div class="col-sm-12">
    <?php echo Form::label('options', 'Options:'); ?>

    <p><?php echo e($applicationSetting->options); ?></p>
</div>

<!-- Application Setting Type Id Field -->
<div class="col-sm-12">
    <?php echo Form::label('application_setting_type_id', 'Application Setting Type Id:'); ?>

    <p><?php echo e($applicationSetting->application_setting_type_id); ?></p>
</div>

<!-- Application Setting Category Id Field -->
<div class="col-sm-12">
    <?php echo Form::label('application_setting_category_id', 'Application Setting Category Id:'); ?>

    <p><?php echo e($applicationSetting->application_setting_category_id); ?></p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    <?php echo Form::label('created_at', 'Created At:'); ?>

    <p><?php echo e($applicationSetting->created_at); ?></p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    <?php echo Form::label('updated_at', 'Updated At:'); ?>

    <p><?php echo e($applicationSetting->updated_at); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_settings\show_fields.blade.php ENDPATH**/ ?>