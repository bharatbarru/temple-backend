<!-- Tour Request Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('tour_request_id', 'Tour Request Id:'); ?>

    <?php echo Form::text('tour_request_id', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Tour Date Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('tour_date', 'Tour Date:'); ?>

    <?php echo Form::text('tour_date', null, ['class' => 'form-control','id'=>'tour_date']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#tour_date').datepicker()
    </script>
<?php $__env->stopPush(); ?>

<!-- Tour Time Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('tour_time', 'Tour Time:'); ?>

    <?php echo Form::text('tour_time', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Alternate Tour Date Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('alternate_tour_date', 'Alternate Tour Date:'); ?>

    <?php echo Form::text('alternate_tour_date', null, ['class' => 'form-control','id'=>'alternate_tour_date']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#alternate_tour_date').datepicker()
    </script>
<?php $__env->stopPush(); ?>

<!-- Alternate Tour Time Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('alternate_tour_time', 'Alternate Tour Time:'); ?>

    <?php echo Form::text('alternate_tour_time', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('email', 'Email:'); ?>

    <?php echo Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('mobile', 'Mobile:'); ?>

    <?php echo Form::text('mobile', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Total Visitors Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('total_visitors', 'Total Visitors:'); ?>

    <?php echo Form::text('total_visitors', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Age Range Of Group Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('age_range_of_group', 'Age Range Of Group:'); ?>

    <?php echo Form::text('age_range_of_group', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Last Visit To Temple Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        <?php echo Form::hidden('last_visit_to_temple', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('last_visit_to_temple', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('last_visit_to_temple', 'Last Visit To Temple', ['class' => 'form-check-label']); ?>

    </div>
</div>

<!-- Comment Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('comment', 'Comment:'); ?>

    <?php echo Form::textarea('comment', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Admin Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('admin_comments', 'Admin Comments:'); ?>

    <?php echo Form::textarea('admin_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Terms Conditions Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        <?php echo Form::hidden('terms_conditions', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('terms_conditions', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('terms_conditions', 'Terms Conditions', ['class' => 'form-check-label']); ?>

    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\temple_tours\fields.blade.php ENDPATH**/ ?>