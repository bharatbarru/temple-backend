<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($applicationSettingType->type); ?></p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <p><?php echo e($applicationSettingType->slug); ?></p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    <?php echo Form::label('created_at', 'Created At:'); ?>

    <p><?php echo e($applicationSettingType->created_at); ?></p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    <?php echo Form::label('updated_at', 'Updated At:'); ?>

    <p><?php echo e($applicationSettingType->updated_at); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_setting_types\show_fields.blade.php ENDPATH**/ ?>