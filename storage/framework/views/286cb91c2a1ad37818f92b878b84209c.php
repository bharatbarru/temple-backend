<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($applicationSettingCategory->name); ?></p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    <?php echo Form::label('created_at', 'Created At:'); ?>

    <p><?php echo e($applicationSettingCategory->created_at); ?></p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    <?php echo Form::label('updated_at', 'Updated At:'); ?>

    <p><?php echo e($applicationSettingCategory->updated_at); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_setting_categories\show_fields.blade.php ENDPATH**/ ?>