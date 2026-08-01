<!-- Tour Request Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tour_request_id', 'Tour Request Id:') !!}
    {!! Form::text('tour_request_id', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Tour Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tour_date', 'Tour Date:') !!}
    {!! Form::text('tour_date', null, ['class' => 'form-control','id'=>'tour_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tour_date').datepicker()
    </script>
@endpush

<!-- Tour Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tour_time', 'Tour Time:') !!}
    {!! Form::text('tour_time', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Alternate Tour Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alternate_tour_date', 'Alternate Tour Date:') !!}
    {!! Form::text('alternate_tour_date', null, ['class' => 'form-control','id'=>'alternate_tour_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#alternate_tour_date').datepicker()
    </script>
@endpush

<!-- Alternate Tour Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alternate_tour_time', 'Alternate Tour Time:') !!}
    {!! Form::text('alternate_tour_time', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Total Visitors Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_visitors', 'Total Visitors:') !!}
    {!! Form::text('total_visitors', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Age Range Of Group Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age_range_of_group', 'Age Range Of Group:') !!}
    {!! Form::text('age_range_of_group', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Last Visit To Temple Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('last_visit_to_temple', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('last_visit_to_temple', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('last_visit_to_temple', 'Last Visit To Temple', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Comment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Admin Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('admin_comments', 'Admin Comments:') !!}
    {!! Form::textarea('admin_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Terms Conditions Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('terms_conditions', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('terms_conditions', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('terms_conditions', 'Terms Conditions', ['class' => 'form-check-label']) !!}
    </div>
</div>