<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control letters-input', 'required', 'maxlength' => 255]); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('email', 'Email:'); ?>

    <?php echo Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'required']); ?>

</div>

<!-- Mobile Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('mobile', 'Mobile:'); ?>

    <?php echo Form::text('mobile', null, ['class' => 'form-control digits-input', 'maxlength' => 10, 'minlength' => 10, 'required']); ?>

</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('address', 'Address:'); ?>

    <?php echo Form::textarea('address', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Pincode Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('pincode', 'Pincode:'); ?>

    <?php echo Form::text('pincode', null, ['class' => 'form-control digits-input', 'maxlength' => 6, 'minlength' => 6]); ?>

</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('publish', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('publish', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('publish', 'Publish', ['class' => 'form-check-label']); ?>

    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\customers\fields.blade.php ENDPATH**/ ?>