<!-- Payment Method Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('payment_method_name', 'Payment Method Name:') !!}
    {!! Form::text('payment_method_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'id' => 'payment_method_name',
    'onkeyup' => 'convertToSlug()']) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6 disbaled_input">
    {!! Form::label('slug', 'Slug:', ['class' => 'span_required']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']) !!}
</div>

<!-- Sandbox Key Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sandbox_key', 'Sandbox Key:') !!}
    {!! Form::text('sandbox_key', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Sandbox Secret Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sandbox_secret', 'Sandbox Secret:') !!}
    {!! Form::text('sandbox_secret', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Live Key Field -->
<div class="form-group col-sm-4">
    {!! Form::label('live_key', 'Live Key:') !!}
    {!! Form::text('live_key', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Live Secret Field -->
<div class="form-group col-sm-4">
    {!! Form::label('live_secret', 'Live Secret:') !!}
    {!! Form::text('live_secret', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        {!! Form::hidden('publish', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('publish', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('publish', 'Publish', ['class' => 'form-check-label']) !!}
    </div>
</div>

@include('common.string-to-slug', ['fieldName' => 'payment_method_name'])
