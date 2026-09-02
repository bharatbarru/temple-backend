<div class="row ">
    <div class="col-md-9">
        <div class="row animation-form">
            <!-- Title Field -->
            <div class="form-group col-sm-4">
                <?php echo Form::label('title', 'Title:', ['class' => 'span_required']); ?>

                <?php echo Form::text('title', null, [
                    'class' => 'form-control',
                    'required',
                    'id' => 'title',
                    'onkeyup' => 'convertToSlug()',
                ]); ?>

            </div>

            <!-- Slug Field -->
            <div class="form-group col-sm-4 disbaled_input">
                <?php echo Form::label('slug', 'Slug:', ['class' => 'span_required']); ?>

                <?php echo Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']); ?>

            </div>

            <!-- Parent Field -->
            <div class="form-group col-sm-4 select-area">
                <?php echo Form::label('parent', 'Parent:', ['class' => 'span_required']); ?>

                <?php echo Form::select('parent', ['root' => 'root'] + $pages->all(), null, [
                    'class' => 'form-control select2',
                    'placeholder' => 'Select Parent',
                    'required',
                ]); ?>

            </div>

            <div class="col-sm-12 customurlblock" style="display: none;">
                <div class="row">
                    <!-- Custom Url Field -->
                    <div class="form-group col-sm-4">
                        <?php echo Form::label('custom_url', 'Custom Url:'); ?>

                        <?php echo Form::text('custom_url', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 pageviewblock" style="display: none;">
                <div class="row">
                    <!-- Banner Image Field -->
                    <?php echo $__env->make('common.image.single-image', [
                        'field_label' => 'Banner Image',
                        'field_name' => 'banner_image',
                        'data' => isset($cms) ? $cms->banner_image : null,
                        'path' => CMS_IMAGE_PATH,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- Image Alt Text Field -->
                    <div class="form-group col-sm-4">
                        <?php echo Form::label('banner_image_alt_text', 'Banner Image Alt Text:'); ?>

                        <?php echo Form::text('banner_image_alt_text', null, ['class' => 'form-control']); ?>

                    </div>

                    <!-- Gallery Field -->
                    <?php echo $__env->make('common.image.multiple-image', [
                        'field_label' => 'gallery',
                        'field_name' => 'gallery',
                        'route' => isset($cms) ? 'remove-multiple-image-item/' . $cms->id . '/' : null,
                        'path' => CMS_IMAGE_PATH,
                        'data' => isset($cms) ? $cms->gallery : null,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="clearfix"></div>

                    <!-- Banner Title Field -->
                    <div class="form-group col-sm-4">
                        <?php echo Form::label('banner_title', 'Banner Title:'); ?>

                        <?php echo Form::text('banner_title', null, ['class' => 'form-control']); ?>

                    </div>

                    <!-- Banner Tagline Field -->
                    <div class="form-group col-sm-4">
                        <?php echo Form::label('banner_tagline', 'Banner Tagline:'); ?>

                        <?php echo Form::text('banner_tagline', null, ['class' => 'form-control']); ?>

                    </div>

                    <!-- Short Description Field -->
                    <div class="form-group col-sm-4">
                        <?php echo Form::label('short_description', 'Short Description:'); ?>

                        <?php echo Form::text('short_description', null, ['class' => 'form-control']); ?>

                    </div>

                    <!-- Content Field -->
                    <div class="form-group textarea-section col-sm-12 col-lg-12">
                        <?php echo Form::label('content', 'Content:'); ?>

                        <?php echo Form::textarea('content', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>

            <div class="col-12 section-title">
                <h4 class="cat-title">Seo Details</h4>
            </div>

            <!-- Seo Title Field -->
            <div class="form-group col-sm-12 col-lg-12">
                <?php echo Form::label('seo_title', 'Seo Title:'); ?>

                <?php echo Form::textarea('seo_title', null, ['class' => 'form-control']); ?>

            </div>

            <!-- Seo Keywords Field -->
            <div class="form-group col-sm-12 col-lg-12">
                <?php echo Form::label('seo_keywords', 'Seo Keywords:'); ?>

                <?php echo Form::textarea('seo_keywords', null, ['class' => 'form-control']); ?>

            </div>

            <!-- Seo Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
                <?php echo Form::label('seo_description', 'Seo Description:'); ?>

                <?php echo Form::textarea('seo_description', null, ['class' => 'form-control']); ?>

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
                        <?php echo Form::radio('type', 'pageview', null, ['required']); ?>

                        Page View
                    </label>
                    <label>
                        <?php echo Form::radio('type', 'customurl'); ?>

                        Custom URL
                    </label>
                    <label>
                        <?php echo Form::radio('type', 'nopage'); ?>

                        No Page
                    </label>
                </div>
            </div>

            <!-- Menu Position Field -->
            <div class="form-group ">
                <h4>Menu Positions</h4>
                <div class="checkbox">
                    <label>
                        <?php echo Form::checkbox('main_menu'); ?>


                        Main Menu
                    </label>
                    <label>
                        <?php echo Form::checkbox('top_menu'); ?>

                        Top Menu
                    </label>
                    <label>
                        <?php echo Form::checkbox('side_menu'); ?>

                        Side Menu
                    </label>
                    <label>
                        <?php echo Form::checkbox('footer_menu'); ?>

                        Footer Menu
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('common.editor', ['variable' => 'editor1', 'field' => 'content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startPush('page_scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\cms\fields.blade.php ENDPATH**/ ?>