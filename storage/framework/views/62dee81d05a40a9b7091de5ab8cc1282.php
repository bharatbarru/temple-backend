<!-- Photo Category Id Field -->
<div class="col-sm-12">
    <?php echo Form::label('photo_category_id', 'Photo Category Id:'); ?>

    <p><?php echo e($photoGallery->photo_category_id); ?></p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    <?php echo Form::label('image', 'Image:'); ?>

    <p><?php echo e($photoGallery->image_gallery); ?></p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <p><?php echo e($photoGallery->image_alt_text); ?></p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    <?php echo Form::label('title', 'Title:'); ?>

    <p><?php echo e($photoGallery->title); ?></p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <p><?php echo e($photoGallery->description); ?></p>
</div>

<!-- Sort Field -->
<div class="col-sm-12">
    <?php echo Form::label('sort', 'Sort:'); ?>

    <p><?php echo e($photoGallery->sort); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\photo_galleries\show_fields.blade.php ENDPATH**/ ?>