<!-- <?php echo e($fieldTitle); ?> Field -->
<div class="form-group col-sm-12">
<?php if($config->options->localized): ?>
    {!! Form::label('<?php echo e($fieldName); ?>', __('models/<?php echo e($config->modelNames->camelPlural); ?>.fields.<?php echo e($fieldName); ?>'), ['class' => 'form-check-label']) !!}
<?php else: ?>
    {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>', ['class' => 'form-check-label']) !!}
<?php endif; ?>
    <?php echo $radioButtons; ?>

</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\fields\radio_group.blade.php ENDPATH**/ ?>