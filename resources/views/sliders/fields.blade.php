<!-- Image Field -->
@include('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($slider) ? $slider->image : null, 'path' => SLIDER_IMAGE_PATH])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-4">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Tagline Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    {!! Form::textarea('tagline', null, ['class' => 'form-control']) !!}
</div>

<!-- Button Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('button_name', 'Button Name:') !!}
    {!! Form::text('button_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Button Url Field -->
<div class="form-group col-sm-4">
    {!! Form::label('button_url', 'Button Url:') !!}
    {!! Form::text('button_url', null, ['class' => 'form-control']) !!}
</div>

<!-- New Window Field -->
<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::checkbox('new_window') !!}

            New Window
        </label>
    </div>
</div>

@include('common.image-preview')