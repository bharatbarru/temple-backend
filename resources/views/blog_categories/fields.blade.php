<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', isset($blogCategory) ? $blogCategory->name : null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', isset($blogCategory) ? $blogCategory->display_name : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', [
    'field_label' => 'Image',
    'field_name' => 'image',
    'data' => isset($blogCategory) ? $blogCategory->image : null,
    'path' => BLOG_CATEGORY_IMAGE_PATH,
])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', isset($blogCategory) ? $blogCategory->image_alt_text : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-4">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', isset($blogCategory) ? $blogCategory->icon : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', isset($blogCategory) ? $blogCategory->description : null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', isset($blogCategory) ? $blogCategory->type : null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>