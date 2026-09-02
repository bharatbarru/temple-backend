<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($serviceType->name); ?></p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <p><?php echo e($serviceType->slug); ?></p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <p><?php echo e($serviceType->display_name); ?></p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    <?php echo Form::label('image', 'Image:'); ?>

    <p><?php echo e($serviceType->image); ?></p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <p><?php echo e($serviceType->image_alt_text); ?></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <p><?php echo e($serviceType->icon); ?></p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <p><?php echo e($serviceType->description); ?></p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    <?php echo Form::label('tagline', 'Tagline:'); ?>

    <p><?php echo e($serviceType->tagline); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\service_types\show_fields.blade.php ENDPATH**/ ?>