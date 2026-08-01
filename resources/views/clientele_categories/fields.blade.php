<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required',
        'maxlength' => 255, isset($clienteleCategory) ? 'readonly' : '', 'onkeyup' => 'convertToSlug()']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type', 'Slug:') !!}
    {!! Form::text('type', null, ['class' => 'form-control', 'id' => 'slug', 'maxlength' => 255, 'readonly']) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Tagline Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    {!! Form::textarea('tagline', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-4">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

@include('common.string-to-slug', ['fieldName' => 'name'])