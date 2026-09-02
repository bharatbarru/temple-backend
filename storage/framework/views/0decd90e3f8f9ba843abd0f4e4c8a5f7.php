<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($serviceCategory->name); ?></p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <p><?php echo e($serviceCategory->slug); ?></p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <p><?php echo e($serviceCategory->display_name); ?></p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    <?php echo Form::label('image', 'Image:'); ?>

    <p><?php echo e($serviceCategory->image); ?></p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <p><?php echo e($serviceCategory->image_alt_text); ?></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <p><?php echo e($serviceCategory->icon); ?></p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <p><?php echo e($serviceCategory->description); ?></p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    <?php echo Form::label('tagline', 'Tagline:'); ?>

    <p><?php echo e($serviceCategory->tagline); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\service_categories\show_fields.blade.php ENDPATH**/ ?>