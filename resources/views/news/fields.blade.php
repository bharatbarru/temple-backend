<!-- News Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('news_category_id', 'News Category:') !!}
    {!! Form::select('news_category_id', $categories, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select News Category',
    ]) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
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
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug',  isset($news) ? $news->slug : null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
        'readonly',
    ]) !!}

<!-- Tagline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tagline', 'Tagline:') !!}
    {!! Form::text('tagline', null, [
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
    'data' => isset($news) ? $news->image : null,
    'path' => NEWS_IMAGE_PATH,
])

<!-- Image Alt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image_alt', 'Image Alt:') !!}
    {!! Form::text('image_alt', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>


<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', isset($news) ? $news->date : null, [
        'class' => 'form-control',
        'id' => 'date',
    ]) !!}
</div>

<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Gallery Field -->
@include('common.image.multiple-image', [
    'field_label' => 'Image Gallery',
    'field_name' => 'gallery',
    'route' => isset($news) ? 'admin/remove-multiple-blogPosts-image-item/' . $news->id . '/' : null,
    'path' => NEWS_IMAGE_PATH,
    'data' => isset($news) ? $news->gallery : null,
])

<!-- Custom Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('custom_url', 'Custom Url:') !!}
    {!! Form::text('custom_url', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- New Window Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('new_window', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('new_window', 'New Window', ['class' => 'form-check-label']) !!}
    </div>
</div>
@include('common.string-to-slug', ['fieldName' => 'title'])