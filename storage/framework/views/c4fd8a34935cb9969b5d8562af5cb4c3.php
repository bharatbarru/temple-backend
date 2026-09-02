<!-- First Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('first_name', 'First Name:'); ?>

    <?php echo Form::text('first_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]); ?>

</div>

<!-- Last Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('last_name', 'Last Name:'); ?>

    <?php echo Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Mobile Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('mobile', 'Mobile:'); ?>

    <?php echo Form::text('mobile', null, ['class' => 'form-control', 'required', 'maxlength' => 255]); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('email', 'Email:'); ?>

    <?php echo Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 255]); ?>

</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-4">
    <?php echo Form::label('address', 'Address:'); ?>

    <?php echo Form::text('address', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Country Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('country', 'Country:'); ?>

    <?php echo Form::text('country', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- State Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('state', 'State:'); ?>

    <?php echo Form::text('state', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- City Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('city', 'City:'); ?>

    <?php echo Form::text('city', null, ['class' => 'form-control']); ?>

</div>

<!-- Pincode Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('pincode', 'Pincode:'); ?>

    <?php echo Form::text('pincode', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Dob Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('dob', 'Dob:'); ?>

    <?php echo Form::text('dob', null, ['class' => 'form-control dateonlypicker','id'=>'dob']); ?>

</div>

<!-- Rashi Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('rashi', 'Rashi:'); ?>

    <?php echo Form::text('rashi', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Birth Star Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('birth_star', 'Birth Star:'); ?>

    <?php echo Form::text('birth_star', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Gothram Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('gothram', 'Gothram:'); ?>

    <?php echo Form::text('gothram', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Spouse Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('spouse_name', 'Spouse Name:'); ?>

    <?php echo Form::text('spouse_name', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Children Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('children_name', 'Children Name:'); ?>

    <?php echo Form::text('children_name', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\frontend_users\fields.blade.php ENDPATH**/ ?>