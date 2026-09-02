<!-- <?php echo e($fieldTitle); ?> Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('<?php echo e($fieldName); ?>', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('<?php echo e($fieldName); ?>', '<?php echo e($checkboxVal); ?>', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>', ['class' => 'form-check-label']) !!}
    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\fields\checkbox.blade.php ENDPATH**/ ?>