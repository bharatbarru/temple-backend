
<!-- Testimonial Category Id Field -->
<div class="form-group col-sm-4 select-area">
    <?php echo Form::label('testimonial_category', 'Category'); ?>

    <?php echo Form::select('testimonial_category_id', $categories, null, ['class' => 'form-control select2', 'placeholder' => 'Select Testimonial Category','required']); ?>

</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Author:'); ?>

    <?php echo Form::text('name', isset($testimonial) ? $testimonial->name: null, ['class' => 'form-control ', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Designation Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('designation', 'Designation:'); ?>

    <?php echo Form::text('designation', isset($testimonial) ? $testimonial->designation : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Rating Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('rating', 'Rating:'); ?>

    <?php echo Form::text('rating', isset($testimonial) ? $testimonial->rating: null, ['class' => 'form-control', 'required']); ?>

</div>


<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($testimonial) ? $testimonial->image : null,
    'path' => TESTIMONIAL_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text',isset($testimonial) ? $testimonial->image_alt_text: null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>





<!-- Custom Url Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('custom_url', 'Video Iframe'); ?>

    <?php echo Form::textarea('custom_url', isset($testimonial) ? $testimonial->custom_url: null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>


<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::textarea('description', isset($testimonial) ? $testimonial->description : null, ['class' => 'form-control editor', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>


<!-- Company Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('company', 'Testimonials URL:'); ?>

    <?php echo Form::text('company', isset($testimonial) ? $testimonial->company: null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div> 



<!-- Short Description Field -->






<!-- Date Field -->






<!-- Image Alt Text Field -->


<!-- Icon Field -->


<!-- Video Url Field -->


<!-- Video Iframe Field -->







<!-- New Window Field -->






<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('common.editor', ['variable' => 'editor9', 'field' => 'custom_url'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\testimonials\fields.blade.php ENDPATH**/ ?>