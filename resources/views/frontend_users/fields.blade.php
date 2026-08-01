<!-- First Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-4">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-4">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-4">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-4">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-4">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Pincode Field -->
<div class="form-group col-sm-4">
    {!! Form::label('pincode', 'Pincode:') !!}
    {!! Form::text('pincode', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Dob Field -->
<div class="form-group col-sm-4">
    {!! Form::label('dob', 'Dob:') !!}
    {!! Form::text('dob', null, ['class' => 'form-control dateonlypicker','id'=>'dob']) !!}
</div>

<!-- Rashi Field -->
<div class="form-group col-sm-4">
    {!! Form::label('rashi', 'Rashi:') !!}
    {!! Form::text('rashi', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Birth Star Field -->
<div class="form-group col-sm-4">
    {!! Form::label('birth_star', 'Birth Star:') !!}
    {!! Form::text('birth_star', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Gothram Field -->
<div class="form-group col-sm-4">
    {!! Form::label('gothram', 'Gothram:') !!}
    {!! Form::text('gothram', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Spouse Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('spouse_name', 'Spouse Name:') !!}
    {!! Form::text('spouse_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Children Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('children_name', 'Children Name:') !!}
    {!! Form::text('children_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>
