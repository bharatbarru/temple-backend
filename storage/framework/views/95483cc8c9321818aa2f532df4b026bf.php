<!-- Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('name', 'Name:'); ?>

    <p><?php echo e($clienteleCategory->name); ?></p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <p><?php echo e($clienteleCategory->display_name); ?></p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    <?php echo Form::label('tagline', 'Tagline:'); ?>

    <p><?php echo e($clienteleCategory->tagline); ?></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <p><?php echo e($clienteleCategory->icon); ?></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($clienteleCategory->type); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\clientele_categories\show_fields.blade.php ENDPATH**/ ?>