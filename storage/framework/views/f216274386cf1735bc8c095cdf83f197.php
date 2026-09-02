<!-- News Category Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('news_category_id', 'News Category:'); ?>

    <?php echo Form::select('news_category_id', $categories, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select News Category',
    ]); ?>

</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
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
<div class="form-group col-sm-6">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <?php echo Form::text('slug',  isset($news) ? $news->slug : null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'readonly',
    ]); ?>


<!-- Tagline Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('tagline', 'Tagline:'); ?>

    <?php echo Form::text('tagline', null, [
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
    'data' => isset($news) ? $news->image : null,
    'path' => NEWS_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('image_alt', 'Image Alt:'); ?>

    <?php echo Form::text('image_alt', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>


<!-- Date Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('date', 'Date:'); ?>

    <?php echo Form::date('date', isset($news) ? $news->date : null, [
        'class' => 'form-control',
        'id' => 'date',
    ]); ?>

</div>

<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('short_description', 'Short Description:'); ?>

    <?php echo Form::textarea('short_description', null, [
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
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Gallery Field -->
<?php echo $__env->make('common.image.multiple-image', [
    'field_label' => 'Image Gallery',
    'field_name' => 'gallery',
    'route' => isset($news) ? 'admin/remove-multiple-blogPosts-image-item/' . $news->id . '/' : null,
    'path' => NEWS_IMAGE_PATH,
    'data' => isset($news) ? $news->gallery : null,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Custom Url Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('custom_url', 'Custom Url:'); ?>

    <?php echo Form::text('custom_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- New Window Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        <?php echo Form::hidden('new_window', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']); ?>

        <?php echo Form::label('new_window', 'New Window', ['class' => 'form-check-label']); ?>

    </div>
</div>
<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\news\fields.blade.php ENDPATH**/ ?>