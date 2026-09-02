<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Name:'); ?>

    <?php echo Form::text('name', isset($hallAddon) ? $hallAddon->name : null, ['class' => 'form-control', 'required', 'maxlength' => 255]); ?>

</div>




<!-- Image Field -->
<?php echo $__env->make('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($hallAddon) ? $hallAddon->image : null, 'path' => HALL_ADDON_IMAGE_PATH], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('image_alt_text', 'Image Alt Text:'); ?>

    <?php echo Form::text('image_alt_text', isset($hallAddon) ? $hallAddon->image_alt_text : null, ['class' => 'form-control', 'maxlength' => 255]); ?>

</div>





<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::textarea('description', isset($hallAddon) ? $hallAddon->description : null, ['class' => 'form-control', 'maxlength' => 65535]); ?>

</div>

<!-- Hall Cost Table -->
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hall Name</th>
                <th>Monday Cost</th>
                <th>Tuesday Cost</th>
                <th>Wednesday Cost</th>
                <th>Thursday Cost</th>
                <th>Friday Cost</th>
                <th>Saturday Cost</th>
                <th>Sunday Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $costs = isset($hallAddon) ? $hallAddon->hallAddonCosts->where('hall_id', $hall->id)->first() : null;
                ?>
                <tr>
                    <td><?php echo e($hall->name); ?></td>
                    <?php $__currentLoopData = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td>
                            <?php echo Form::text("costs[{$hall->id}][{$day}]", $costs ? $costs->{$day . '_cost'} : null, ['class' => 'form-control numbers-input', 'required']); ?>

                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php echo $__env->make('common.editor', ['field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\hall_addons\fields.blade.php ENDPATH**/ ?>