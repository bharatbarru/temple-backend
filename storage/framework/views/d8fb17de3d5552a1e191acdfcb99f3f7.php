<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($permission->name); ?></p>
</div>

<!-- Guard Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('guard_name', 'Guard Name:'); ?>

    <p><?php echo e($permission->guard_name); ?></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($permission->type); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\user-management\permissions\show_fields.blade.php ENDPATH**/ ?>