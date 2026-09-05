<div class="form-group col-sm-4">
    <label><?php echo e($field_label); ?></label>

    <div class="input-group image_input">
        <div class="custom-file">
            <?php echo Form::file($field_name, [
                'class' => 'custom-file-input',
                'onchange' => 'readURL(this, "image_preview' . $field_name . '")',
            ]); ?>

            <?php echo Form::label($field_name, $field_label, ['class' => 'custom-file-label']); ?>

        </div>
    </div>
    <div id="image_preview<?php echo e($field_name); ?>">
        <?php if(!empty($data)): ?>
            <img src="<?php echo e(asset($path . $data)); ?>" alt="" height="50">
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/common/image/single-image.blade.php ENDPATH**/ ?>