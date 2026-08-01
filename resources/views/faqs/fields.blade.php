<!-- Faq Categories Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('faq_categories_id', 'Faq Categories Id:') !!}
    {!! Form::select('faq_categories_id', $categories, null, ['class' => 'form-control select2', 'required' , 'placeholder' => ' Select Faq Category ']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-4">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Answer Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('answer', 'Answer:') !!}
    {!! Form::textarea('answer', null, ['class' => 'form-control editor', 'required', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Button Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('button_name', 'Button Name:') !!}
    {!! Form::text('button_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Button Url Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('button_url', 'Button Url:') !!}
    {!! Form::textarea('button_url', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- New Window Field -->
<div class="form-group col-sm-4">
    <div class="form-check">
        {!! Form::hidden('new_window', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('new_window', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('new_window', 'New Window', ['class' => 'form-check-label']) !!}
    </div>
</div>
{{--
<!-- Sort Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sort', 'Sort:') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
</div> --}}

@include('common.editor', ['variable' => 'editor1', 'field' => 'answer'])
