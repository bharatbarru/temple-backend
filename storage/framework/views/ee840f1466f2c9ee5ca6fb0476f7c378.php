<!-- Title Field -->
<div class="col-sm-12">
    <?php echo Form::label('title', 'Title:'); ?>

    <p><?php echo e($statistics->title); ?></p>
</div>

<!-- Number Field -->
<div class="col-sm-12">
    <?php echo Form::label('number', 'Number:'); ?>

    <p><?php echo e($statistics->number); ?></p>
</div>

<!-- Prefix Field -->
<div class="col-sm-12">
    <?php echo Form::label('prefix', 'Prefix:'); ?>

    <p><?php echo e($statistics->prefix); ?></p>
</div>

<!-- Suffix Field -->
<div class="col-sm-12">
    <?php echo Form::label('suffix', 'Suffix:'); ?>

    <p><?php echo e($statistics->suffix); ?></p>
</div>

<!-- Url Field -->
<div class="col-sm-12">
    <?php echo Form::label('url', 'Url:'); ?>

    <p><?php echo e($statistics->url); ?></p>
</div>

<!-- New Window Field -->
<div class="col-sm-12">
    <?php echo Form::label('new_window', 'New Window:'); ?>

    <p><?php echo e($statistics->new_window); ?></p>
</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\statistics\show_fields.blade.php ENDPATH**/ ?>