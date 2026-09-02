<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control', 'required',
        'maxlength' => 255, isset($clienteleCategory) ? 'readonly' : '', 'onkeyup' => 'convertToSlug()']); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('type', 'Slug:'); ?>

    <?php echo Form::text('type', null, ['class' => 'form-control', 'id' => 'slug', 'maxlength' => 255, 'readonly']); ?>

</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <?php echo Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Tagline Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('tagline', 'Tagline:'); ?>

    <?php echo Form::textarea('tagline', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Icon Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <?php echo Form::text('icon', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\clientele_categories\fields.blade.php ENDPATH**/ ?>