<!-- Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', 'Name'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('email', 'Email'); ?>

    <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('password', 'Password'); ?>

    <?php echo Form::password('password', ['class' => 'form-control']); ?>

</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('password', 'Password Confirmation'); ?>

    <?php echo Form::password('password_confirmation', ['class' => 'form-control']); ?>

</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\users\fields.blade.php ENDPATH**/ ?>