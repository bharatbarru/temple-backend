<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $serviceCategory->name }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $serviceCategory->slug }}</p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{{ $serviceCategory->display_name }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $serviceCategory->image }}</p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    <p>{{ $serviceCategory->image_alt_text }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{{ $serviceCategory->icon }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $serviceCategory->description }}</p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    <p>{{ $serviceCategory->tagline }}</p>
</div>

