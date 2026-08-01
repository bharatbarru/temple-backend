<!-- Faq Categories Id Field -->
<div class="col-sm-12">
    {!! Form::label('faq_categories_id', 'Faq Categories Id:') !!}
    <p>{{ $faq->faq_categories_id }}</p>
</div>

<!-- Question Field -->
<div class="col-sm-12">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $faq->question }}</p>
</div>

<!-- Answer Field -->
<div class="col-sm-12">
    {!! Form::label('answer', 'Answer:') !!}
    <p>{{ $faq->answer }}</p>
</div>

<!-- Button Name Field -->
<div class="col-sm-12">
    {!! Form::label('button_name', 'Button Name:') !!}
    <p>{{ $faq->button_name }}</p>
</div>

<!-- Button Url Field -->
<div class="col-sm-12">
    {!! Form::label('button_url', 'Button Url:') !!}
    <p>{{ $faq->button_url }}</p>
</div>

<!-- New Window Field -->
<div class="col-sm-12">
    {!! Form::label('new_window', 'New Window:') !!}
    <p>{{ $faq->new_window }}</p>
</div>

<!-- Sort Field -->
<div class="col-sm-12">
    {!! Form::label('sort', 'Sort:') !!}
    <p>{{ $faq->sort }}</p>
</div>

