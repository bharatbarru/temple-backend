
<?php if(request()->get('type')): ?>
    <input type="hidden" name="service_category_id" value="<?php echo e($serviceCategory->id); ?>" />
<?php endif; ?>

<input type="hidden" name="type" value="<?php echo e(request()->get('type')); ?>" />
<input type="hidden" name="main" value="<?php echo e(request()->get('main')); ?>" />


<div class="col-md-12 h2 border-bottom pb-3 mb-3">Service List </div>

<!-- Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', null, [
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

<!-- Service Category Id Field -->
<?php if($serviceCategories): ?>
    <div class="form-group col-sm-4">
        <?php echo Form::label('service_category_id', 'Service Category:'); ?>

        <?php echo Form::select('service_category_id', $serviceCategories, null, [
            'class' => 'form-control select2',
            'placeholder' => 'Select Service Category',
            'required',
        ]); ?>

    </div>
<?php endif; ?>

<!-- Sub Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('sub_title', 'Sub Title:'); ?>

    <?php echo Form::text('sub_title', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>


<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($sevice) ? $sevice->image : null,
    'path' => SERVICE_IMAGE_PATH,
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


<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('short_description', 'Short Description:'); ?>

    <?php echo Form::textarea('short_description', null, [
        'class' => 'form-control editor',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<div class="col-md-12 h2 border-bottom pb-3 mb-3 mt-3">Service Details </div>

<!-- Banner Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Banner Image',
    'field_name' => 'banner_image',
    'data' => isset($sevice) ? $sevice->banner_image : null,
    'path' => SERVICE_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Gallery Field -->
<?php echo $__env->make('common.image.multiple-image', [
    'field_label' => 'gallery',
    'field_name' => 'gallery',
    'route' => isset($service) ? 'admin/remove-multiple-service-image-item/' . $service->id . '/' : null,
    'path' => SERVICE_IMAGE_PATH,
    'data' => isset($service) ? $service->gallery : null,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



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



<!-- Icon Field -->


<!-- Video Url Field -->


<!-- Custom Url Field -->


<!-- New Window Field -->





<!-- Video Iframe Field -->


<div class="col-md-12 h2 border-bottom pb-3 mb-3">Seo</div>

<!-- Page Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('page_title', 'Page Title:'); ?>

    <?php echo Form::textarea('page_title', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_title', 'Seo Title:'); ?>

    <?php echo Form::textarea('seo_title', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Seo Keywords Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_keywords', 'Seo Keywords:'); ?>

    <?php echo Form::textarea('seo_keywords', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_description', 'Seo Description:'); ?>

    <?php echo Form::textarea('seo_description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        <?php echo Form::hidden('publish', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('publish', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('publish', 'Publish', ['class' => 'form-check-label']); ?>

    </div>
</div>



<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'description', 'short_description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'short_description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\services\fields.blade.php ENDPATH**/ ?>