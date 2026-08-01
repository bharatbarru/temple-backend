
@if(request()->get('type'))
    <input type="hidden" name="service_category_id" value="{{ $serviceCategory->id }}" />
@endif

<input type="hidden" name="type" value="{{ request()->get('type') }}" />
<input type="hidden" name="main" value="{{ request()->get('main') }}" />


<div class="col-md-12 h2 border-bottom pb-3 mb-3">Service List </div>

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

<!-- Service Category Id Field -->
@if($serviceCategories)
    <div class="form-group col-sm-4">
        {!! Form::label('service_category_id', 'Service Category:') !!}
        {!! Form::select('service_category_id', $serviceCategories, null, [
            'class' => 'form-control select2',
            'placeholder' => 'Select Service Category',
            'required',
        ]) !!}
    </div>
@endif

<!-- Sub Title Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sub_title', 'Sub Title:') !!}
    {!! Form::text('sub_title', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>


<!-- Image Field -->
@include('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($sevice) ? $sevice->image : null,
    'path' => SERVICE_IMAGE_PATH,
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
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', null, [
        'class' => 'form-control editor',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<div class="col-md-12 h2 border-bottom pb-3 mb-3 mt-3">Service Details </div>

<!-- Banner Image Field -->
@include('common.image.single-image', [
    'field_label' => 'Banner Image',
    'field_name' => 'banner_image',
    'data' => isset($sevice) ? $sevice->banner_image : null,
    'path' => SERVICE_IMAGE_PATH,
])

<!-- Gallery Field -->
@include('common.image.multiple-image', [
    'field_label' => 'gallery',
    'field_name' => 'gallery',
    'route' => isset($service) ? 'admin/remove-multiple-service-image-item/' . $service->id . '/' : null,
    'path' => SERVICE_IMAGE_PATH,
    'data' => isset($service) ? $service->gallery : null,
])



<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control editor',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>



<!-- Icon Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('icon', 'Phone:') !!}
    {!! Form::text('icon', null, [
        'class' => 'form-control',
       
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Video Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('video_url', 'Email') !!}
    {!! Form::text('video_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- Custom Url Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('custom_url', 'Map Url or Button Url:') !!}
    {!! Form::text('custom_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div> --}}

<!-- New Window Field -->
{{-- <div class="form-group col-sm-4" style="margin-top: 30px">
    <div class="form-check">
        {!! Form::hidden('new_window', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('new_window', 'New Window', ['class' => 'form-check-label']) !!}
    </div>
</div> --}}




<!-- Video Iframe Field -->
{{-- <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('video_iframe', 'Video Iframe:') !!}
    {!! Form::textarea('video_iframe', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div> --}}

<div class="col-md-12 h2 border-bottom pb-3 mb-3">Seo</div>

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



@include('common.string-to-slug', ['fieldName' => 'title'])
@include('common.editor', ['variable' => 'editor1', 'field' => 'description', 'short_description'])
@include('common.editor', ['variable' => 'editor1', 'field' => 'short_description'])


