<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $testimonialCategory->name }}</p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{{ $testimonialCategory->display_name }}</p>
</div>

<!-- Testimonial Type Field -->
<div class="col-sm-12">
    {!! Form::label('testimonial_type', 'Testimonial Type:') !!}
    <p>{{ $testimonialCategory->testimonial_type }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{{ $testimonialCategory->icon }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $testimonialCategory->type }}</p>
</div>

