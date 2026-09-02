<div class="form-group col-sm-12">
    <label><?php echo e($field_label); ?></label>

    <div class="input-group image_input">
        <div class="custom-file">
            <?php echo Form::file($field_name.'[]', [
                'class' => 'custom-file-input',
                'onchange' => 'readURL(this, "image_preview' . $field_name . '")', 'multiple'
            ]); ?>

            <?php echo Form::label($field_name, $field_label, ['class' => 'custom-file-label']); ?>

        </div>
    </div>

    <div id="image_preview<?php echo e($field_name); ?>"></div>

    <?php if($data != null): ?>
        <?php $__currentLoopData = json_decode($data, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <a href="<?php echo e(url($route . $key)); ?>" class="remove-gal-item" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                <img src="<?php echo e(asset($path . $image['path'])); ?>" alt="" width="100">
                <?php echo Form::text('multiple_alt_text' . $field_name . '[]', $image['alt_text'], ['class' => 'form-control', 'placeholder' => 'Image Alt Text']); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<?php echo $__env->make('common.image-preview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\common\image\multiple-image.blade.php ENDPATH**/ ?>