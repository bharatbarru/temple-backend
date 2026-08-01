<!-- Photo Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('photo_category_id', 'Photo Category Id:') !!}
    <p>{{ $photoGallery->photo_category_id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $photoGallery->image_gallery }}</p>
</div>

<!-- Image Alt Text Field -->
<div class="col-sm-12">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    <p>{{ $photoGallery->image_alt_text }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $photoGallery->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $photoGallery->description }}</p>
</div>

<!-- Sort Field -->
<div class="col-sm-12">
    {!! Form::label('sort', 'Sort:') !!}
    <p>{{ $photoGallery->sort }}</p>
</div>

