<div class="row ">
    <div class="col-md-9">
        <div class="row animation-form">
            <!-- Title Field -->
            <div class="form-group col-sm-4">
                {!! Form::label('title', 'Title:', ['class' => 'span_required']) !!}
                {!! Form::text('title', null, [
                    'class' => 'form-control',
                    'required',
                    'id' => 'title',
                    'onkeyup' => 'convertToSlug()',
                ]) !!}
            </div>

            <!-- Slug Field -->
            <div class="form-group col-sm-4 disbaled_input">
                {!! Form::label('slug', 'Slug:', ['class' => 'span_required']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']) !!}
            </div>

            <!-- Parent Field -->
            <div class="form-group col-sm-4 select-area">
                {!! Form::label('parent', 'Parent:', ['class' => 'span_required']) !!}
                {!! Form::select('parent', ['root' => 'root'] + $pages->all(), null, [
                    'class' => 'form-control select2',
                    'placeholder' => 'Select Parent',
                    'required',
                ]) !!}
            </div>

            <div class="col-sm-12 customurlblock" style="display: none;">
                <div class="row">
                    <!-- Custom Url Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('custom_url', 'Custom Url:') !!}
                        {!! Form::text('custom_url', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 pageviewblock" style="display: none;">
                <div class="row">
                    <!-- Banner Image Field -->
                    @include('common.image.single-image', [
                        'field_label' => 'Banner Image',
                        'field_name' => 'banner_image',
                        'data' => isset($cms) ? $cms->banner_image : null,
                        'path' => CMS_IMAGE_PATH,
                    ])
                    <!-- Image Alt Text Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('banner_image_alt_text', 'Banner Image Alt Text:') !!}
                        {!! Form::text('banner_image_alt_text', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Gallery Field -->
                    @include('common.image.multiple-image', [
                        'field_label' => 'gallery',
                        'field_name' => 'gallery',
                        'route' => isset($cms) ? 'remove-multiple-image-item/' . $cms->id . '/' : null,
                        'path' => CMS_IMAGE_PATH,
                        'data' => isset($cms) ? $cms->gallery : null,
                    ])
                    <div class="clearfix"></div>

                    <!-- Banner Title Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('banner_title', 'Banner Title:') !!}
                        {!! Form::text('banner_title', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Banner Tagline Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('banner_tagline', 'Banner Tagline:') !!}
                        {!! Form::text('banner_tagline', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Short Description Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('short_description', 'Short Description:') !!}
                        {!! Form::text('short_description', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Content Field -->
                    <div class="form-group textarea-section col-sm-12 col-lg-12">
                        {!! Form::label('content', 'Content:') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-12 section-title">
                <h4 class="cat-title">Seo Details</h4>
            </div>

            <!-- Seo Title Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('seo_title', 'Seo Title:') !!}
                {!! Form::textarea('seo_title', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Seo Keywords Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('seo_keywords', 'Seo Keywords:') !!}
                {!! Form::textarea('seo_keywords', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Seo Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('seo_description', 'Seo Description:') !!}
                {!! Form::textarea('seo_description', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="right-side-page">
            <!-- Type Field -->
            <div class="form-group ">
                <h4>Page Types <span class="required-span" style="color: red">*</span></h4>
                <div class="radio">
                    <label>
                        {!! Form::radio('type', 'pageview', null, ['required']) !!}
                        Page View
                    </label>
                    <label>
                        {!! Form::radio('type', 'customurl') !!}
                        Custom URL
                    </label>
                    <label>
                        {!! Form::radio('type', 'nopage') !!}
                        No Page
                    </label>
                </div>
            </div>

            <!-- Menu Position Field -->
            <div class="form-group ">
                <h4>Menu Positions</h4>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('main_menu') !!}

                        Main Menu
                    </label>
                    <label>
                        {!! Form::checkbox('top_menu') !!}
                        Top Menu
                    </label>
                    <label>
                        {!! Form::checkbox('side_menu') !!}
                        Side Menu
                    </label>
                    <label>
                        {!! Form::checkbox('footer_menu') !!}
                        Footer Menu
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

@include('common.string-to-slug', ['fieldName' => 'title'])

@include('common.editor', ['variable' => 'editor1', 'field' => 'content'])

@push('page_scripts')
    <script type="text/javascript">
        function pagetype(type) {
            if (type == 'pageview') {
                $(".pageviewblock").show();
                $(".customurlblock").hide();
                $("#custom_url").val('');
            } else if (type == 'customurl') {
                $(".customurlblock").show();
                $(".pageviewblock").hide();
            } else if (type == 'nopage') {
                $(".customurlblock").hide();
                $(".pageviewblock").hide();
                $("#custom_url").val('');
            }
        }
        $(document).ready(function() {
            $(".customurlblock").hide();
            $(".pageviewblock").hide();
            var type = $('input[name="type"]:checked').val();
            pagetype(type);
            $('input[type=radio][name=type]').change(function() {
                pagetype(this.value);
            });
        });
    </script>
@endpush
