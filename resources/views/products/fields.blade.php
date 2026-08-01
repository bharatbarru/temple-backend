



<!-- Product Category Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('product_category_id', 'Product Category:') !!}
    {!! Form::select('product_category_id', $categories, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Product Category',
        'required',
    ]) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-4">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, [
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
    {!! Form::text('slug', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'readonly',
    ]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-4">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, [
        'class' => 'form-control numbers-input',
    ]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($product) ? $product->image : null,
    'path' => PRODUCT_IMAGE_PATH,
])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>


<!-- Short Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
    ]) !!}
</div>

<div class="col-sm-12 mt-4 mb-3 border-bottom pb-3">
   <h2 class="text-danger">Menu Details</h2>
</div>


<!-- Sub Title Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sub_title', 'Details Title:') !!}
    {!! Form::text('sub_title', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>


<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control'
    ]) !!}

</div>


<div class="col-sm-12 mt-4 mb-3 border-bottom pb-3">
    <h2 class="text-danger">Seo Section</h2>
 </div>



<!-- Post Date Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('post_date', 'Post Date:') !!}
    {!! Form::date('post_date', null, ['class' => 'form-control', 'id' => 'post_date']) !!}
</div> --}}







{{-- @include('common.image.multiple-image', [
    'field_label' => 'Image Gallery',
    'field_name' => 'image_gallery',
    'route' => isset($product) ? 'admin/remove-multiple-products-image-item/' . $product->id . '/' : null,
    'path' => PRODUCT_IMAGE_PATH,
    'data' => isset($product) ? $product->image_gallery : null,
]) --}}

<!-- Video Gallery Field -->
{{-- <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('video_gallery', 'Video Gallery:') !!}
    {!! Form::textarea('video_gallery', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div> --}}

<!-- Video Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('video_url', 'Video Url:') !!}
    {!! Form::text('video_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Video Iframe Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('video_iframe', 'Video Iframe:') !!}
    {!! Form::text('video_iframe', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Custom Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('custom_url', 'Custom Url:') !!}
    {!! Form::text('custom_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Map Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('map_url', 'Map Url:') !!}
    {!! Form::text('map_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Map Iframe Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('map_iframe', 'Map Iframe:') !!}
    {!! Form::text('map_iframe', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Page Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('page_title', 'Page Title:') !!}
    {!! Form::textarea('page_title', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('seo_title', 'Seo Title:') !!}
    {!! Form::textarea('seo_title', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Seo Keywords Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('seo_keywords', 'Seo Keywords:') !!}
    {!! Form::textarea('seo_keywords', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('seo_description', 'Seo Description:') !!}
    {!! Form::textarea('seo_description', null, [
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
        {!! Form::checkbox('publish', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('publish', 'Publish', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Special Product Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        {!! Form::hidden('special_product', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('special_product', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('special_product', 'Special Product', ['class' => 'form-check-label']) !!}
    </div>
</div>
{{-- 
<!-- Sort Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sort', 'Sort:') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
</div> --}}


@include('common.string-to-slug', ['fieldName' => 'title'])
@include('common.editor', ['variable' => 'editor1', 'field' => 'description'])
{{-- @include('common.editor', ['variable' => 'editor1', 'field' => 'short_description']) --}}
