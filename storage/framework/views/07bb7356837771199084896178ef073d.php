<!-- Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Number Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('number', 'Number:'); ?>

    <?php echo Form::text('number', null, ['class' => 'form-control digits-input', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Prefix Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('prefix', 'Prefix:'); ?>

    <?php echo Form::text('prefix', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Suffix Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('suffix', 'Suffix:'); ?>

    <?php echo Form::text('suffix', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Url Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('url', 'Url:'); ?>

    <?php echo Form::textarea('url', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- New Window Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('new_window', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('new_window', 'New Window', ['class' => 'form-check-label']); ?>

    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\statistics\fields.blade.php ENDPATH**/ ?>