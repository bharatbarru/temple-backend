<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', isset($blogCategory) ? $blogCategory->name : null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('display_name', 'Display Name:'); ?>

    <?php echo Form::text('display_name', isset($blogCategory) ? $blogCategory->display_name : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($blogCategory) ? $blogCategory->image : null,
    'path' => BLOG_CATEGORY_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', isset($blogCategory) ? $blogCategory->image_alt_text : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Icon Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('icon', 'Icon:'); ?>

    <?php echo Form::text('icon', isset($blogCategory) ? $blogCategory->icon : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::textarea('description', isset($blogCategory) ? $blogCategory->description : null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Type Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('type', 'Type:'); ?>

    <?php echo Form::text('type', isset($blogCategory) ? $blogCategory->type : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\blog_categories\fields.blade.php ENDPATH**/ ?>