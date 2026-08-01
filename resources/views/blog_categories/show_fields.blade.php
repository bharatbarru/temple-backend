<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $blogCategory->name }}</p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{{ $blogCategory->display_name }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $blogCategory->image }}</p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    <p>{{ $blogCategory->image_alt_text }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{{ $blogCategory->icon }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $blogCategory->description }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $blogCategory->type }}</p>
</div>

