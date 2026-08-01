<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $slider->image }}</p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    <p>{{ $slider->image_alt_text }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $slider->title }}</p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    <p>{{ $slider->tagline }}</p>
</div>

<!-- Button Name Field -->
<div class="col-sm-12">
    {!! Form::label('button_name', 'Button Name:') !!}
    <p>{{ $slider->button_name }}</p>
</div>

<!-- Button Url Field -->
<div class="col-sm-12">
    {!! Form::label('button_url', 'Button Url:') !!}
    <p>{{ $slider->button_url }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $slider->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $slider->updated_at }}</p>
</div>

