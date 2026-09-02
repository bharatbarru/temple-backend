<!-- 'Boolean <?php echo e($fieldTitle); ?> Field' checked by default -->
<div class="form-group col-sm-6">
<?php if($config->options->localized): ?>
    {!! Form::label('<?php echo e($fieldName); ?>', __('models/<?php echo e($config->modelNames->camelPlural); ?>.fields.<?php echo e($fieldName); ?>').':') !!}
<?php else: ?>
    {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>:') !!}
<?php endif; ?>
    <label class="checkbox-inline">
    {!! Form::checkbox('<?php echo e($fieldName); ?>', 1, true) !!}
    <!-- remove {, true} to make it unchecked by default -->
    </label>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\fields\boolean.blade.php ENDPATH**/ ?>