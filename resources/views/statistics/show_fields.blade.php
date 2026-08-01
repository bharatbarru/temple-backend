<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $statistics->title }}</p>
</div>

<!-- Number Field -->
<div class="col-sm-12">
    {!! Form::label('number', 'Number:') !!}
    <p>{{ $statistics->number }}</p>
</div>

<!-- Prefix Field -->
<div class="col-sm-12">
    {!! Form::label('prefix', 'Prefix:') !!}
    <p>{{ $statistics->prefix }}</p>
</div>

<!-- Suffix Field -->
<div class="col-sm-12">
    {!! Form::label('suffix', 'Suffix:') !!}
    <p>{{ $statistics->suffix }}</p>
</div>

<!-- Url Field -->
<div class="col-sm-12">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $statistics->url }}</p>
</div>

<!-- New Window Field -->
<div class="col-sm-12">
    {!! Form::label('new_window', 'New Window:') !!}
    <p>{{ $statistics->new_window }}</p>
</div>

