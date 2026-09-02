<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($testimonialCategory->name); ?></p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <p><?php echo e($testimonialCategory->display_name); ?></p>
</div>

<!-- Testimonial Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('testimonial_type', 'Testimonial Type:'); ?>

    <p><?php echo e($testimonialCategory->testimonial_type); ?></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <p><?php echo e($testimonialCategory->icon); ?></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($testimonialCategory->type); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\testimonial_categories\show_fields.blade.php ENDPATH**/ ?>