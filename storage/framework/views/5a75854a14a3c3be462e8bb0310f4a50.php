<!-- Event Category Id Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('event_category_id', 'Event Category:'); ?>

    <?php echo Form::select('event_category_id', $eventCategories, null, ['class' => 'form-control select2', 'required' , 'placeholder' => ' Select Event Category']); ?>

</div>

<!-- Title Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('title', 'Title:'); ?>

    <?php echo Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'required', 'maxlength' => 255, 'onkeyup' => 'convertToSlug()']); ?>

</div>

<!-- Slug Field -->
<div class="form-group col-sm-4 disbaled_input">
    <?php echo Form::label('slug', 'Slug:', ['class' => 'span_required']); ?>

    <?php echo Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug', 'readonly']); ?>

</div>

<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($event) ? $event->image : null, 'path' => EVENT_IMAGE_PATH], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Start Date Time Field -->
<div class="form-group col-sm-4 date-icon">
    <?php echo Form::label('start_date_time', 'Start Date & Time:'); ?>

    <?php echo Form::text('start_date_time', isset($event) ? formatDateTime($event->start_date_time) : null, ['class' => 'form-control datetimepicker','id'=>'start_date_time']); ?>

</div>

<!-- End Date Time Field -->
<div class="form-group col-sm-4 date-icon">
    <?php echo Form::label('end_date_time', 'End Date & Time:'); ?>

    <?php echo Form::text('end_date_time', isset($event) ? formatDateTime($event->end_date_time) : null, ['class' => 'form-control datetimepicker','id'=>'end_date_time']); ?>

</div>

<!-- Custom Url Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('custom_url', 'Custom Url:'); ?>

    <?php echo Form::text('custom_url', null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>

<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('short_description', 'Short Description:'); ?>

    <?php echo Form::textarea('short_description', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php
        $defaultDescription = <<<HTML
<div style="display: flex; align-items: center; justify-content: left; gap: 10px; margin: 50px 0;"><span style="color: red; font-weight: bold;">To Sponsor:</span><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank"><input name="cmd" type="hidden" value="_s-xclick"> <input name="hosted_button_id" type="hidden" value="VJD5MSQ4Q6S3W"> <input title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" type="image"> <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0"></form></div>
<p><strong>Select&nbsp;</strong>Temple Event Sponsorship<strong><br><img src="https://admin.htom.us/images/media/screenshot_cm7j9vtoa.png"><br></strong></p>
<p>&nbsp;</p>
HTML;
    ?>
    <?php echo Form::textarea('description', old('description', isset($event) ? $event->description : $defaultDescription), ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_title', 'Seo Title:'); ?>

    <?php echo Form::textarea('seo_title', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Seo Keywords Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_keywords', 'Seo Keywords:'); ?>

    <?php echo Form::textarea('seo_keywords', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('seo_description', 'Seo Description:'); ?>

    <?php echo Form::textarea('seo_description', null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<?php echo $__env->make('common.string-to-slug', ['fieldName' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('common.editor', ['field' => 'short_description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.editor', ['field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        // Override slug generator for Events: append a unique timestamp on create only
        (function () {
            // var isEdit = <?php echo isset($event) ? 'true' : 'false'; ?>;
            var isEdit = <?php echo 'false'; ?>;
            // Short per-page unique suffix (6 chars), stable while typing
            var uniqueSuffix = (Date.now().toString(36) + Math.random().toString(36).slice(2,6)).slice(-6);

            window.convertToSlug = function () {
                var text = $("#title").val() || '';
                var base = text.toLowerCase().trim()
                    .replace(/\s+/g, '-')        // spaces to dashes
                    .replace(/[^\w-]+/g, '')     // remove non-word chars
                    .replace(/-+/g, '-')          // collapse multiple dashes
                    .replace(/^-+|-+$/g, '');     // trim dashes

                if (!isEdit) {
                    // Only append unique suffix when creating a new event
                    $("#slug").val(base ? base + '-' + uniqueSuffix : uniqueSuffix);
                } else {
                    $("#slug").val(base);
                }
            };
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\events\fields.blade.php ENDPATH**/ ?>