<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Home Amount Field -->
<div class="form-group col-sm-4">
    {!! Form::label('home_amount', 'Home Amount:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ currencySymbol() }}</span>
        </div>
        {!! Form::text('home_amount', isset($puja) ? $puja->home_amount : null, ['class' => 'form-control numbers-input', 'id' => 'home_amount']) !!}
    </div>
</div>

<!-- Temple Amount Field -->
<div class="form-group col-sm-4">
    {!! Form::label('temple_amount', 'Temple Amount:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ currencySymbol() }}</span>
        </div>
        {!! Form::text('temple_amount', isset($puja) ? $puja->temple_amount : null, ['class' => 'form-control numbers-input', 'id' => 'temple_amount']) !!}
    </div>
</div>
