<!-- News Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('news_category_id', 'News Category Id:') !!}
    <p>{{ $news->news_category_id }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $news->title }}</p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    <p>{{ $news->tagline }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $news->image }}</p>
</div>

<!-- Image Alt Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt', 'Image Alt:') !!}
    <p>{{ $news->image_alt }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $news->date }}</p>
</div>

<!-- Short Description Field -->
<div class="col-sm-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    <p>{{ $news->short_description }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $news->description }}</p>
</div>

<!-- Gallery Field -->
<div class="col-sm-12">
    {!! Form::label('gallery', 'Gallery:') !!}
    <p>{{ $news->gallery }}</p>
</div>

<!-- Custom Url Field -->
<div class="col-sm-12">
    {!! Form::label('custom_url', 'Custom Url:') !!}
    <p>{{ $news->custom_url }}</p>
</div>

<!-- New Window Field -->
<div class="col-sm-12">
    {!! Form::label('new_window', 'New Window:') !!}
    <p>{{ $news->new_window }}</p>
</div>

