<!-- Photo Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo_category_id', 'Photo Category:') !!}
    {!! Form::select('photo_category_id', $categories, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Photo Gallery Category',
        'required',
    ]) !!}
</div>

@include('common.image.multiple-image', [
    'field_label' => 'Image Gallery:',
    'field_name' => 'image_gallery',
    'route' => isset($photoGallery)
        ? 'admin/remove-multiple-photoGallery-image-item/' . $photoGallery->id . '/'
        : null,
    'path' => PHOTO_GALLERY_IMAGE_PATH,
    'data' => isset($photoGallery) ? $photoGallery->image_gallery : null,
])

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, [
        'class' => 'form-control',
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
    ]) !!}
</div>