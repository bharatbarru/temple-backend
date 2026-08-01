<!-- Title Field -->
<div class="form-group col-sm-4">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('number', 'Number:') !!}
    {!! Form::text('number', null, ['class' => 'form-control digits-input', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Prefix Field -->
<div class="form-group col-sm-4">
    {!! Form::label('prefix', 'Prefix:') !!}
    {!! Form::text('prefix', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Suffix Field -->
<div class="form-group col-sm-4">
    {!! Form::label('suffix', 'Suffix:') !!}
    {!! Form::text('suffix', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::textarea('url', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- New Window Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        {!! Form::hidden('new_window', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('new_window', 'New Window', ['class' => 'form-check-label']) !!}
    </div>
</div>