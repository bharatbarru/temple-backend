<!-- Title Field -->
<div class="col-sm-12">
    <?php echo Form::label('title', 'Title:'); ?>

    <p><?php echo e($cms->title); ?></p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    <?php echo Form::label('slug', 'Slug:'); ?>

    <p><?php echo e($cms->slug); ?></p>
</div>

<!-- Parent Field -->
<div class="col-sm-12">
    <?php echo Form::label('parent', 'Parent:'); ?>

    <p><?php echo e($cms->parent != 'root' ? $cms->parentName->title : 'root'); ?></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    <?php echo Form::label('type', 'Type:'); ?>

    <p><?php echo e($cms->type); ?></p>
</div>

<!-- Custom Url Field -->
<div class="col-sm-12">
    <?php echo Form::label('custom_url', 'Custom Url:'); ?>

    <p><?php echo e($cms->custom_url); ?></p>
</div>

<!-- Banner Image Field -->
<div class="col-sm-12">
    <?php echo Form::label('banner_image', 'Banner Image:'); ?>

    <p>
        <?php if($cms->banner_image): ?>
            <img src="<?php echo e(asset(CMS_IMAGE_PATH . $cms->banner_image)); ?>" alt="<?php echo e($cms->banner_image_alt_text); ?>" style="width: 100px; height: 100px;">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </p>
</div>

<!-- Banner Title Field -->
<div class="col-sm-12">
    <?php echo Form::label('banner_title', 'Banner Title:'); ?>

    <p><?php echo e($cms->banner_title); ?></p>
</div>

<!-- Banner Tagline Field -->
<div class="col-sm-12">
    <?php echo Form::label('banner_tagline', 'Banner Tagline:'); ?>

    <p><?php echo e($cms->banner_tagline); ?></p>
</div>

<!-- Short Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('short_description', 'Short Description:'); ?>

    <?php echo $cms->short_description; ?>

</div>

<!-- Content Field -->
<div class="col-sm-12">
    <?php echo Form::label('content', 'Content:'); ?>

    <?php echo $cms->content; ?>

</div>

<!-- Seo Title Field -->
<div class="col-sm-12">
    <?php echo Form::label('seo_title', 'Seo Title:'); ?>

    <p><?php echo e($cms->seo_title); ?></p>
</div>

<!-- Seo Keywords Field -->
<div class="col-sm-12">
    <?php echo Form::label('seo_keywords', 'Seo Keywords:'); ?>

    <p><?php echo e($cms->seo_keywords); ?></p>
</div>

<!-- Seo Description Field -->
<div class="col-sm-12">
    <?php echo Form::label('seo_description', 'Seo Description:'); ?>

    <p><?php echo e($cms->seo_description); ?></p>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\cms\show_fields.blade.php ENDPATH**/ ?>