<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control letters-input', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'required']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-4">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control digits-input', 'maxlength' => 10, 'minlength' => 10, 'required']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
</div>

<!-- Pincode Field -->
<div class="form-group col-sm-4">
    {!! Form::label('pincode', 'Pincode:') !!}
    {!! Form::text('pincode', null, ['class' => 'form-control digits-input', 'maxlength' => 6, 'minlength' => 6]) !!}
</div>

<!-- Publish Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        {!! Form::hidden('publish', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('publish', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('publish', 'Publish', ['class' => 'form-check-label']) !!}
    </div>
</div>