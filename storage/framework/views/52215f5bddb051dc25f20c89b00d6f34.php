<!-- Clientele Category Id Field -->

<input type="hidden" name="clientele_category_id" value="<?php echo e($clienteleCategory->id); ?>" />

<input type="hidden" name="type" value="<?php echo e(request()->get('type')); ?>" />

<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($clientele) ? $clientele->image : null,
    'path' => CLIENTELE_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Sub Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('sub_title', 'Sub Title:'); ?>

    <?php echo Form::textarea('sub_title', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('url', 'Url:'); ?>

    <?php echo Form::text('url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- New Window Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('new_window', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('new_window', 'New Window', ['class' => 'form-check-label']); ?>

    </div>
</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('publish', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('publish', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('publish', 'Publish', ['class' => 'form-check-label']); ?>

    </div>
</div>

<!-- Sort Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('sort', 'Sort:'); ?>

    <?php echo Form::number('sort', null, ['class' => 'form-control']); ?>

</div>

<?php echo $__env->make('common.editor', ['variable' => 'editor7', 'field' => 'sub_title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\clienteles\fields.blade.php ENDPATH**/ ?>