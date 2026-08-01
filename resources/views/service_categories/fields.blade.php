<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255, 'onkeyup' => 'convertToSlug()']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255, 'readonly']) !!}
</div>

<!-- Service Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('service_type_id', 'Service Type') !!}
    {!! Form::select('service_type_id', $type, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select service type',
    ]) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($seviceCategory) ? $seviceCategory->image : null, 'path' => SERVICE_IMAGE_PATH])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-4">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Tagline Field -->
<div class="form-group col-sm-4">
    {!! Form::label('tagline', 'Tagline:') !!}
    {!! Form::text('tagline', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

@include('common.string-to-slug', ['fieldName' => 'name'])
@include('common.editor', ['variable' => 'editor5', 'field' => 'description'])