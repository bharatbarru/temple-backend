<!-- Payment Method Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('payment_method_name', 'Payment Method Name:'); ?>

    <?php echo Form::text('payment_method_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'id' => 'payment_method_name',
    'onkeyup' => 'convertToSlug()']); ?>

</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <?php echo Form::text('display_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-6 disbaled_input">
    <?php echo Form::label('slug', 'Slug:', ['class' => 'span_required']); ?>

    <?php echo Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']); ?>

</div>

<!-- Sandbox Key Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('sandbox_key', 'Sandbox Key:'); ?>

    <?php echo Form::text('sandbox_key', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Sandbox Secret Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('sandbox_secret', 'Sandbox Secret:'); ?>

    <?php echo Form::text('sandbox_secret', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Live Key Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('live_key', 'Live Key:'); ?>

    <?php echo Form::text('live_key', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Live Secret Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('live_secret', 'Live Secret:'); ?>

    <?php echo Form::text('live_secret', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('publish', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('publish', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('publish', 'Publish', ['class' => 'form-check-label']); ?>

    </div>
</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'payment_method_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\payment_methods\fields.blade.php ENDPATH**/ ?>