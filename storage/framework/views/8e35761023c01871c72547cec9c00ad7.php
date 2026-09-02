<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($user->name); ?></p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    <?php echo Form::label('email', 'Email:'); ?>

    <p><?php echo e($user->email); ?></p>
</div>

<!-- Mobile Field -->
<div class="col-sm-12">
    <?php echo Form::label('mobile', 'Mobile:'); ?>

    <p><?php echo e($user->mobile); ?></p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    <?php echo Form::label('address', 'Address:'); ?>

    <p><?php echo e($user->address); ?></p>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\user-management\users\show_fields.blade.php ENDPATH**/ ?>