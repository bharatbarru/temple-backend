<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name', ['class' => 'span-required']); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control letters-input', 'required']); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('email', 'Email', ['class' => 'span-required']); ?>

    <?php echo Form::email('email', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']); ?>





</div>

<!-- Mobile Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('mobile', 'Mobile'); ?>

    <?php echo Form::text('mobile', null, [
        'class' => 'form-control digits-input',
    
        'minlength' => 10,
        'maxlength' => 10,
    ]); ?>

</div>

<!-- Role Field -->
<div class="form-group select-required select2-group col-sm-6">

    <?php echo Form::label('role', 'Select Role'); ?>

    <select class="form-control select2" name="role" required>
        <option value="">Select Role</option>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php echo e(isset($user) ? ($user->hasRole($role->name) ? 'selected' : '') : ''); ?>><?php echo e($role->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('address', 'Address'); ?>

    <?php echo Form::textarea('address', null, ['class' => 'form-control']); ?>

</div>

<?php if(!isset($user)): ?>
    <!-- Password Field -->
    <div class="form-group col-sm-4">

        <?php echo Form::label('password', 'Password', ['class' => 'span-required']); ?>


        <?php echo Form::password('password', [
            'class' => 'form-control',
            'id' => 'password',
            'autocomplete' => 'off',
            'required',
            'data-parsley-minlength' => '8',
        ]); ?>

    </div>

    <!-- Confirmation Password Field -->
    <div class="form-group col-sm-4">

        <?php echo Form::label('password_confirmation', 'Confirm Password', ['class' => 'span-required']); ?>


        <?php echo Form::password('password_confirmation', [
            'class' => 'form-control',
            'autocomplete' => 'off',
            'required',
            'data-parsley-equalto' => '#password',
        ]); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\user-management\users\fields.blade.php ENDPATH**/ ?>