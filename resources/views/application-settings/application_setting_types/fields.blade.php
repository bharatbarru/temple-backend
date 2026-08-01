<!-- Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control', 'required', 'onkeyup' => 'convertToSlug()']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-4">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'required', 'readonly']) !!}
</div>

@include('common.string-to-slug', ['fieldName' => 'type'])