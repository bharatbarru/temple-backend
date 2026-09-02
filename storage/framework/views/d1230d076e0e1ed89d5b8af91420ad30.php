<!-- Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', isset($blogPost) ? $blogPost->title : null, [
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

    <?php echo Form::text('slug', isset($blogPost) ? $blogPost->slug : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'readonly',
    ]); ?>

</div>





<!-- Blog Category Id Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('blog_category_id', 'Blog Category:'); ?>

    <?php echo Form::select('blog_category_id', $categories, isset($blogPost) ? $blogPost->categories : null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Blog Category',
        'required',
    ]); ?>

</div>




<!-- Post Date Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('post_date', 'Post Date:'); ?>

    <?php echo Form::date('post_date', isset($blogPost) ? $blogPost->post_date : null, [
        'class' => 'form-control',
        'id' => 'post_date',
    ]); ?>

</div>

<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($blogPost) ? $blogPost->image : null,
    'path' => BLOG_POST_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', isset($blogPost) ? $blogPost->image_alt_text : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]); ?>

</div>

<!-- Author Image Field -->
<?php echo $__env->make('common.image.single-image', [
    'field_label' => 'Author Image',
    'field_name' => 'author_image',
    'data' => isset($blogPost) ? $blogPost->author_image : null,
    'path' => BLOG_POST_IMAGE_PATH,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::textarea('description', isset($blogPost) ? $blogPost->description : null, [
        'class' => 'form-control',
    ]); ?>

</div>


<!-- Short Description Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('short_description', 'Short Description:'); ?>

    <?php echo Form::textarea('short_description', isset($blogPost) ? $blogPost->short_description : null, [
        'class' => 'form-control',
    ]); ?>

</div>


<!-- Image Gallery Field -->


<!-- Video Gallery Field -->


<!-- Video Url Field -->


<!-- Video Iframe Field -->


<!-- Custom Url Field -->


<!-- Map Url Field -->


<!-- Map Iframe Field -->


<!-- Page Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('page_title', 'Page Title:'); ?>

    <?php echo Form::textarea('page_title', isset($blogPost) ? $blogPost->page_title : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_title', 'Seo Title:'); ?>

    <?php echo Form::textarea('seo_title', isset($blogPost) ? $blogPost->seo_title : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Seo Keywords Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_keywords', 'Seo Keywords:'); ?>

    <?php echo Form::textarea('seo_keywords', isset($blogPost) ? $blogPost->seo_keywords : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]); ?>

</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_description', 'Seo Description:'); ?>

    <?php echo Form::textarea('seo_description', isset($blogPost) ? $blogPost->seo_description : null, [
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

        <?php echo Form::checkbox('publish', '1', isset($blogPost) ? $blogPost->publish : null, [
            'class' => 'form-check-input',
        ]); ?>

        <?php echo Form::label('publish', 'Publish', ['class' => 'form-check-label']); ?>

    </div>
</div>




<!-- Sub Title Field -->










<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'short_description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\blog_posts\fields.blade.php ENDPATH**/ ?>