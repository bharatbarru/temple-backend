<!-- <?php echo e($fieldTitle); ?> Field -->
<div class="form-group col-sm-6">
<?php if($config->options->localized): ?>
    {!! Form::label('<?php echo e($fieldName); ?>', __('models/<?php echo e($config->modelNames->camelPlural); ?>.fields.<?php echo e($fieldName); ?>').':') !!}
<?php else: ?>
    {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>:') !!}
<?php endif; ?>
    {!! Form::select('<?php echo e($fieldName); ?>', <?php echo htmlspecialchars_decode($selectValues) ?>, null, ['class' => 'form-control custom-select']) !!}
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\fields\select.blade.php ENDPATH**/ ?>