<div class="col-sm-6">
    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('name', 'Name:'); ?> 
            <span class="float-right"><?php echo e($eventCategory->name); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('slug', 'Slug:'); ?>

            <span class="float-right"><?php echo e($eventCategory->slug); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('display_name', 'Display Name:'); ?>

            <span class="float-right"><?php echo e($eventCategory->display_name); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('image', 'Image:'); ?>

            <span class="float-right">
                <?php if(!empty($eventCategory->image)): ?>
                    <img src="<?php echo e(asset(EVENT_CATEGORY_IMAGE_PATH . $eventCategory->image)); ?>" alt="Category Image" height="50">
                <?php endif; ?>
            </span>
        </li>
        <li class="nav-item">
            <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

            <span class="float-right"><?php echo e($eventCategory->image_alt_text); ?></span>
        </li>
    </ul>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\event_categories\show_fields.blade.php ENDPATH**/ ?>