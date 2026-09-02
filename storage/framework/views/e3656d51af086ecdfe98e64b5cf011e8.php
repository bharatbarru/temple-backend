<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($newsCategory->name); ?></p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <p><?php echo e($newsCategory->slug); ?></p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    <?php echo Form::label('title', 'Title:'); ?>

    <p><?php echo e($newsCategory->title); ?></p>
</div>

<!-- Tag Line Field -->
<div class="col-sm-12">
    <?php echo Form::label('tag_line', 'Tag Line:'); ?>

    <p><?php echo e($newsCategory->tag_line); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\news_categories\show_fields.blade.php ENDPATH**/ ?>