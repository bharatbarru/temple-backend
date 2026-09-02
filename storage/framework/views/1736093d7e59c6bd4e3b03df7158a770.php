<!-- Puja Request Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('puja_request_id', 'Puja Request Id:'); ?>

    <?php echo Form::text('puja_request_id', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('user_id', 'User Id:'); ?>

    <?php echo Form::number('user_id', null, ['class' => 'form-control', 'required']); ?>

</div>

<!-- Puja Location Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('puja_location', 'Puja Location:'); ?>

    <?php echo Form::text('puja_location', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Date Of Puja Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('date_of_puja', 'Date Of Puja:'); ?>

    <?php echo Form::text('date_of_puja', null, ['class' => 'form-control','id'=>'date_of_puja']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#date_of_puja').datepicker()
    </script>
<?php $__env->stopPush(); ?>

<!-- Time Of Puja Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('time_of_puja', 'Time Of Puja:'); ?>

    <?php echo Form::text('time_of_puja', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Alternate Date Of Puja1 Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('alternate_date_of_puja1', 'Alternate Date Of Puja1:'); ?>

    <?php echo Form::text('alternate_date_of_puja1', null, ['class' => 'form-control','id'=>'alternate_date_of_puja1']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#alternate_date_of_puja1').datepicker()
    </script>
<?php $__env->stopPush(); ?>

<!-- Alternate Time Of Puja1 Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('alternate_time_of_puja2', 'Alternate Time Of Puja1:'); ?>

    <?php echo Form::text('alternate_time_of_puja2', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>



<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('total_amount', 'Total Amount:'); ?>

    <?php echo Form::number('total_amount', null, ['class' => 'form-control']); ?>

</div>

<!-- Priest Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('priest_name', 'Priest Name:'); ?>

    <?php echo Form::text('priest_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('comments', 'Comments:'); ?>

    <?php echo Form::textarea('comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Admin Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('admin_comments', 'Admin Comments:'); ?>

    <?php echo Form::textarea('admin_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Cancelled By Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('cancelled_by', 'Cancelled By:'); ?>

    <?php echo Form::text('cancelled_by', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Cancelled Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('cancelled_comments', 'Cancelled Comments:'); ?>

    <?php echo Form::textarea('cancelled_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Changed By Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('changed_by', 'Changed By:'); ?>

    <?php echo Form::text('changed_by', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Changed Comments Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('changed_comments', 'Changed Comments:'); ?>

    <?php echo Form::text('changed_comments', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Payment Status Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('payment_status', 'Payment Status:'); ?>

    <?php echo Form::text('payment_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Terms Conditions Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        <?php echo Form::hidden('terms_conditions', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('terms_conditions', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('terms_conditions', 'Terms Conditions', ['class' => 'form-check-label']); ?>

    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\puja_orders\fields.blade.php ENDPATH**/ ?>