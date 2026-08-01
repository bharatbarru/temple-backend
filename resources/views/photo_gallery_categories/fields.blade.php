<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, [
        'class' => 'form-control',
    ]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['homepage' => 'Homepage', 'gallery' => 'Gallery'], null, [
        'class' => 'form-control',
    ]) !!}
</div>

<!-- Sort Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sort', 'Sort:') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
</div>
