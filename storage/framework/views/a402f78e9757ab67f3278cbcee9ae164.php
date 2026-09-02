<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($blogCategory->name); ?></p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <p><?php echo e($blogCategory->display_name); ?></p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    <?php echo Form::label('image', 'Image:'); ?>

    <p><?php echo e($blogCategory->image); ?></p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <p><?php echo e($blogCategory->image_alt_text); ?></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <p><?php echo e($blogCategory->icon); ?></p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <p><?php echo e($blogCategory->description); ?></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($blogCategory->type); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\blog_categories\show_fields.blade.php ENDPATH**/ ?>