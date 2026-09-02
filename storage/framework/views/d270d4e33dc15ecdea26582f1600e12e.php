<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]); ?>

</div>

<!-- Home Amount Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('home_amount', 'Home Amount:'); ?>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><?php echo e(currencySymbol()); ?></span>
        </div>
        <?php echo Form::text('home_amount', isset($puja) ? $puja->home_amount : null, ['class' => 'form-control numbers-input', 'id' => 'home_amount']); ?>

    </div>
</div>

<!-- Temple Amount Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('temple_amount', 'Temple Amount:'); ?>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><?php echo e(currencySymbol()); ?></span>
        </div>
        <?php echo Form::text('temple_amount', isset($puja) ? $puja->temple_amount : null, ['class' => 'form-control numbers-input', 'id' => 'temple_amount']); ?>

    </div>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pujas\fields.blade.php ENDPATH**/ ?>