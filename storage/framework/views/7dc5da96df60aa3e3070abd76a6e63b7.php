<!-- Team Categories Id Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('team_categories_id', 'Team Categories Id:'); ?>

    <?php echo Form::select('team_categories_id', $categories, null, [
        'class' => 'form-control select2',
        'required',
        'placeholder' => 'Select Team Category',
    ]); ?>

</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'onkeyup' => 'convertToSlug()',
    ]); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <?php echo Form::text('slug', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'readonly',
    ]); ?>

</div>

<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($team) ? $team->image : null,
    'path' => TEAM_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Designation Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('designation', 'Designation:'); ?>

    <?php echo Form::text('designation', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>


<!-- Github Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('github_url', 'Phone Number:'); ?>

    <?php echo Form::text('github_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Other Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('other', 'Email Address:'); ?>

    <?php echo Form::textarea('other', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>


<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::textarea('description', null, [
        'class' => 'form-control editor',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Linkedin Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('linkedin_url', 'Linkedin Url:'); ?>

    <?php echo Form::text('linkedin_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Facebook Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('facebook_url', 'Facebook Url:'); ?>

    <?php echo Form::text('facebook_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Instagram Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('instagram_url', 'Instagram Url:'); ?>

    <?php echo Form::text('instagram_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Twitter Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('twitter_url', 'Twitter Url:'); ?>

    <?php echo Form::text('twitter_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>








<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\teams\fields.blade.php ENDPATH**/ ?>