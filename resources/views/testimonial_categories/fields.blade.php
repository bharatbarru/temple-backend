<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Display Name Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> --}}

<!-- Testimonial Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('testimonial_type', 'Testimonial Type:') !!}
    {!! Form::text('testimonial_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Icon Field -->
{{-- <div class="form-group col-sm-4">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> --}}

<!-- Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type', 'Page Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>