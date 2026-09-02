<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($slider) ? $slider->image : null, 'path' => SLIDER_IMAGE_PATH], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', null, ['class' => 'form-control']); ?>

</div>

<!-- Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

</div>

<!-- Tagline Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('tagline', 'Tagline:'); ?>

    <?php echo Form::textarea('tagline', null, ['class' => 'form-control']); ?>

</div>

<!-- Button Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('button_name', 'Button Name:'); ?>

    <?php echo Form::text('button_name', null, ['class' => 'form-control']); ?>

</div>

<!-- Button Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('button_url', 'Button Url:'); ?>

    <?php echo Form::text('button_url', null, ['class' => 'form-control']); ?>

</div>

<!-- New Window Field -->
<div class="form-group">
    <div class="checkbox">
        <label>
            <?php echo Form::checkbox('new_window'); ?>


            New Window
        </label>
    </div>
</div>

<?php echo $__env->make('common.image-preview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\sliders\fields.blade.php ENDPATH**/ ?>