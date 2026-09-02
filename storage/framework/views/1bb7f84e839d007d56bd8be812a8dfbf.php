<!-- <?php echo e($fieldName); ?> Field -->
<div class="form-group col-sm-6">
<?php if($config->options->localized): ?>
    {!! Form::label('<?php echo e($fieldName); ?>', __('models/<?php echo e($config->modelNames->camelPlural); ?>.fields.<?php echo e($fieldName); ?>').':') !!}
<?php else: ?>
    {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>:') !!}
<?php endif; ?>
    {!! Form::password('<?php echo e($fieldName); ?>', ['class' => 'form-control'<?php if(isset($options)) { echo htmlspecialchars_decode($options); } ?>]) !!}
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\fields\password.blade.php ENDPATH**/ ?>