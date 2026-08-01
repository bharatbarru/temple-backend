<!-- Puja Request Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('puja_request_id', 'Puja Request Id:') !!}
    {!! Form::text('puja_request_id', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Puja Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('puja_location', 'Puja Location:') !!}
    {!! Form::text('puja_location', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Date Of Puja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_of_puja', 'Date Of Puja:') !!}
    {!! Form::text('date_of_puja', null, ['class' => 'form-control','id'=>'date_of_puja']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_of_puja').datepicker()
    </script>
@endpush

<!-- Time Of Puja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time_of_puja', 'Time Of Puja:') !!}
    {!! Form::text('time_of_puja', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Alternate Date Of Puja1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alternate_date_of_puja1', 'Alternate Date Of Puja1:') !!}
    {!! Form::text('alternate_date_of_puja1', null, ['class' => 'form-control','id'=>'alternate_date_of_puja1']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#alternate_date_of_puja1').datepicker()
    </script>
@endpush

<!-- Alternate Time Of Puja1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alternate_time_of_puja2', 'Alternate Time Of Puja1:') !!}
    {!! Form::text('alternate_time_of_puja2', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>



<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::number('total_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Priest Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('priest_name', 'Priest Name:') !!}
    {!! Form::text('priest_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Admin Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('admin_comments', 'Admin Comments:') !!}
    {!! Form::textarea('admin_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Cancelled By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cancelled_by', 'Cancelled By:') !!}
    {!! Form::text('cancelled_by', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Cancelled Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('cancelled_comments', 'Cancelled Comments:') !!}
    {!! Form::textarea('cancelled_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Changed By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('changed_by', 'Changed By:') !!}
    {!! Form::text('changed_by', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Changed Comments Field -->
<div class="form-group col-sm-6">
    {!! Form::label('changed_comments', 'Changed Comments:') !!}
    {!! Form::text('changed_comments', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Payment Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    {!! Form::text('payment_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Terms Conditions Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('terms_conditions', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('terms_conditions', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('terms_conditions', 'Terms Conditions', ['class' => 'form-check-label']) !!}
    </div>
</div>