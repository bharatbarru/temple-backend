<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required', 'maxlength' => 255, 'onkeyup' => 'convertToSlug()']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-4 disbaled_input">
    {!! Form::label('slug', 'Slug:', ['class' => 'span_required']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($eventCategory) ? $eventCategory->image : null, 'path' => EVENT_CATEGORY_IMAGE_PATH])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

@include('common.string-to-slug', ['fieldName' => 'name'])
