<!-- 'bootstrap / Toggle Switch <?php echo e($fieldTitle); ?> Field' -->
<div class="form-group col-sm-6">
    <div class="custom-control custom-switch">
        {!! Form::checkbox('<?php echo e($fieldName); ?>', 1, null,  ['class' => 'custom-control-input']) !!}
<?php if($config->options->localized): ?>
        {!! Form::label('<?php echo e($fieldName); ?>', __('models/<?php echo e($config->modelNames->camelPlural); ?>.fields.<?php echo e($fieldName); ?>').':', ['class' => 'custom-control-label']) !!}
<?php else: ?>
        {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>:', ['class' => 'custom-control-label']) !!}
<?php endif; ?>
    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\fields\toggle-switch.blade.php ENDPATH**/ ?>