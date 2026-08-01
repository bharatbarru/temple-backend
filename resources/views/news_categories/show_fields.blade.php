<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $newsCategory->name }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $newsCategory->slug }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $newsCategory->title }}</p>
</div>

<!-- Tag Line Field -->
<div class="col-sm-12">
    {!! Form::label('tag_line', 'Tag Line:') !!}
    <p>{{ $newsCategory->tag_line }}</p>
</div>

