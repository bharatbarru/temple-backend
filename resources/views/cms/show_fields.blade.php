<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $cms->title }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $cms->slug }}</p>
</div>

<!-- Parent Field -->
<div class="col-sm-12">
    {!! Form::label('parent', 'Parent:') !!}
    <p>{{ $cms->parent != 'root' ? $cms->parentName->title : 'root' }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $cms->type }}</p>
</div>

<!-- Custom Url Field -->
<div class="col-sm-12">
    {!! Form::label('custom_url', 'Custom Url:') !!}
    <p>{{ $cms->custom_url }}</p>
</div>

<!-- Banner Image Field -->
<div class="col-sm-12">
    {!! Form::label('banner_image', 'Banner Image:') !!}
    <p>
        @if($cms->banner_image)
            <img src="{{ asset(CMS_IMAGE_PATH . $cms->banner_image) }}" alt="{{ $cms->banner_image_alt_text }}" style="width: 100px; height: 100px;">
        @else
            No Image
        @endif
    </p>
</div>

<!-- Banner Title Field -->
<div class="col-sm-12">
    {!! Form::label('banner_title', 'Banner Title:') !!}
    <p>{{ $cms->banner_title }}</p>
</div>

<!-- Banner Tagline Field -->
<div class="col-sm-12">
    {!! Form::label('banner_tagline', 'Banner Tagline:') !!}
    <p>{{ $cms->banner_tagline }}</p>
</div>

<!-- Short Description Field -->
<div class="col-sm-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! $cms->short_description !!}
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    {!! $cms->content !!}
</div>

<!-- Seo Title Field -->
<div class="col-sm-12">
    {!! Form::label('seo_title', 'Seo Title:') !!}
    <p>{{ $cms->seo_title }}</p>
</div>

<!-- Seo Keywords Field -->
<div class="col-sm-12">
    {!! Form::label('seo_keywords', 'Seo Keywords:') !!}
    <p>{{ $cms->seo_keywords }}</p>
</div>

<!-- Seo Description Field -->
<div class="col-sm-12">
    {!! Form::label('seo_description', 'Seo Description:') !!}
    <p>{{ $cms->seo_description }}</p>
</div>