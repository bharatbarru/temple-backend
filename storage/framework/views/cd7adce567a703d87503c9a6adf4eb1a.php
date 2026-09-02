<!-- Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Display Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <?php echo Form::text('display_name', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <?php echo Form::text('icon', null, [
        'class' => 'form-control',
    ]); ?>

</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('type', 'Type:'); ?>

    <?php echo Form::select('type', ['homepage' => 'Homepage', 'gallery' => 'Gallery'], null, [
        'class' => 'form-control',
    ]); ?>

</div>

<!-- Sort Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('sort', 'Sort:'); ?>

    <?php echo Form::number('sort', null, ['class' => 'form-control']); ?>

</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\photo_gallery_categories\fields.blade.php ENDPATH**/ ?>