<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $serviceType->name }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $serviceType->slug }}</p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{{ $serviceType->display_name }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $serviceType->image }}</p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    <p>{{ $serviceType->image_alt_text }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{{ $serviceType->icon }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $serviceType->description }}</p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    <p>{{ $serviceType->tagline }}</p>
</div>

