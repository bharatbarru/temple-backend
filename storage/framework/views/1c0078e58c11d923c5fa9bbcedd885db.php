<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($productCategory->name); ?></p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <p><?php echo e($productCategory->display_name); ?></p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    <?php echo Form::label('image', 'Image:'); ?>

    <p><?php echo e($productCategory->image); ?></p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <p><?php echo e($productCategory->image_alt_text); ?></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <p><?php echo e($productCategory->icon); ?></p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <p><?php echo e($productCategory->description); ?></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($productCategory->type); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\product_categories\show_fields.blade.php ENDPATH**/ ?>