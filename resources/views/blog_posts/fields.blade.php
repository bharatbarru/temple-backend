<!-- Title Field -->
<div class="form-group col-sm-4">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', isset($blogPost) ? $blogPost->title : null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'onkeyup' => 'convertToSlug()',
    ]) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', isset($blogPost) ? $blogPost->slug : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'readonly',
    ]) !!}
</div>





<!-- Blog Category Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('blog_category_id', 'Blog Category:') !!}
    {!! Form::select('blog_category_id', $categories, isset($blogPost) ? $blogPost->categories : null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Blog Category',
        'required',
    ]) !!}
</div>




<!-- Post Date Field -->
<div class="form-group col-sm-4">
    {!! Form::label('post_date', 'Post Date:') !!}
    {!! Form::date('post_date', isset($blogPost) ? $blogPost->post_date : null, [
        'class' => 'form-control',
        'id' => 'post_date',
    ]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($blogPost) ? $blogPost->image : null,
    'path' => BLOG_POST_IMAGE_PATH,
])


<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', isset($blogPost) ? $blogPost->image_alt_text : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Author Image Field -->
@include('common.image.single-image', [
    'field_label' => 'Author Image',
    'field_name' => 'author_image',
    'data' => isset($blogPost) ? $blogPost->author_image : null,
    'path' => BLOG_POST_IMAGE_PATH,
])

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', isset($blogPost) ? $blogPost->description : null, [
        'class' => 'form-control',
    ]) !!}
</div>


<!-- Short Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', isset($blogPost) ? $blogPost->short_description : null, [
        'class' => 'form-control',
    ]) !!}
</div>


<!-- Image Gallery Field -->
{{-- @include('common.image.multiple-image', [
    'field_label' => 'Image Gallery',
    'field_name' => 'image_gallery',
    'route' => isset($blogPost) ? 'admin/remove-multiple-blogPosts-image-item/' . $blogPost->id . '/' : null,
    'path' => BLOG_POST_IMAGE_PATH,
    'data' => isset($blogPost) ? $blogPost->image_gallery : null,
]) --}}

<!-- Video Gallery Field -->
{{-- <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('video_gallery', 'Video Gallery:') !!}
    {!! Form::textarea('video_gallery', isset($blogPost) ? $blogPost->video_gallery : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div> --}}

<!-- Video Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('video_url', 'Video Url:') !!}
    {!! Form::text('video_url', isset($blogPost) ? $blogPost->video_url : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Video Iframe Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('video_iframe', 'Video Iframe:') !!}
    {!! Form::text('video_iframe', isset($blogPost) ? $blogPost->video_iframe : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Custom Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('custom_url', 'Custom Url:') !!}
    {!! Form::text('custom_url', isset($blogPost) ? $blogPost->custom_url : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Map Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('map_url', 'Map Url:') !!}
    {!! Form::text('map_url', isset($blogPost) ? $blogPost->map_url : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Map Iframe Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('map_iframe', 'Map Iframe:') !!}
    {!! Form::text('map_iframe', isset($blogPost) ? $blogPost->map_iframe : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Page Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('page_title', 'Page Title:') !!}
    {!! Form::textarea('page_title', isset($blogPost) ? $blogPost->page_title : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('seo_title', 'Seo Title:') !!}
    {!! Form::textarea('seo_title', isset($blogPost) ? $blogPost->seo_title : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Seo Keywords Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('seo_keywords', 'Seo Keywords:') !!}
    {!! Form::textarea('seo_keywords', isset($blogPost) ? $blogPost->seo_keywords : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('seo_description', 'Seo Description:') !!}
    {!! Form::textarea('seo_description', isset($blogPost) ? $blogPost->seo_description : null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        {!! Form::hidden('publish', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('publish', '1', isset($blogPost) ? $blogPost->publish : null, [
            'class' => 'form-check-input',
        ]) !!}
        {!! Form::label('publish', 'Publish', ['class' => 'form-check-label']) !!}
    </div>
</div>




<!-- Sub Title Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('sub_title', 'Sub Title:') !!}
    {!! Form::text('sub_title', isset($blogPost) ? $blogPost->sub_title : null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}







{{--
<!-- Sort Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sort', 'Sort:') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
</div> --}}

@include('common.string-to-slug', ['fieldName' => 'title'])
@include('common.editor', ['variable' => 'editor1', 'field' => 'description'])
@include('common.editor', ['variable' => 'editor1', 'field' => 'short_description'])
