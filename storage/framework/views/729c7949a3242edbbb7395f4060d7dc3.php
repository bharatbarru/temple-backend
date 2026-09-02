<!-- Photo Category Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('photo_category_id', 'Photo Category:'); ?>

    <?php echo Form::select('photo_category_id', $categories, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Photo Gallery Category',
        'required',
    ]); ?>

</div>

<?php echo $__env->make('common.image.multiple-image', [
    'field_label' => 'Image Gallery:',
    'field_name' => 'image_gallery',
    'route' => isset($photoGallery)
        ? 'admin/remove-multiple-photoGallery-image-item/' . $photoGallery->id . '/'
        : null,
    'path' => PHOTO_GALLERY_IMAGE_PATH,
    'data' => isset($photoGallery) ? $photoGallery->image_gallery : null,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Title Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', null, [
        'class' => 'form-control',
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::textarea('description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
    ]); ?>

</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\photo_galleries\fields.blade.php ENDPATH**/ ?>