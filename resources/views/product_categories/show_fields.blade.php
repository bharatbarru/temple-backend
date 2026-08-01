<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $productCategory->name }}</p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{{ $productCategory->display_name }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $productCategory->image }}</p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    <p>{{ $productCategory->image_alt_text }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{{ $productCategory->icon }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $productCategory->description }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $productCategory->type }}</p>
</div>

