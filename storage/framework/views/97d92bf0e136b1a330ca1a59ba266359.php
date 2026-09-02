<!-- Faq Categories Id Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('faq_categories_id', 'Faq Categories Id:'); ?>

    <?php echo Form::select('faq_categories_id', $categories, null, ['class' => 'form-control select2', 'required' , 'placeholder' => ' Select Faq Category ']); ?>

</div>

<!-- Question Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('question', 'Question:'); ?>

    <?php echo Form::text('question', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Answer Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('answer', 'Answer:'); ?>

    <?php echo Form::textarea('answer', null, ['class' => 'form-control editor', 'required', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Button Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('button_name', 'Button Name:'); ?>

    <?php echo Form::text('button_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Button Url Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('button_url', 'Button Url:'); ?>

    <?php echo Form::textarea('button_url', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- New Window Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('new_window', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('new_window', 'New Window', ['class' => 'form-check-label']); ?>

    </div>
</div>


<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'answer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\faqs\fields.blade.php ENDPATH**/ ?>