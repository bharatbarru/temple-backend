<!-- Name Field -->
<div class="col-sm-6">


    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('name', 'Name:'); ?> <span class="float-right "><?php echo e($hallAddon->name); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('description', 'Description:'); ?><span class="float-right "><?php echo e($hallAddon->description); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('image', 'Image:'); ?>

            <?php if(!empty($hallAddon->image)): ?>
                <span class="float-right "> <img src="<?php echo e(asset(HALL_ADDON_IMAGE_PATH . $hallAddon->image)); ?>"
                        alt="" height="50"></span>
            <?php endif; ?>
        </li>

    </ul>
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
                <?php $__currentLoopData = $hallAddon->hallAddonCosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($cost->hall->name); ?></td>
                        <td><?php echo e(formatAmount($cost->monday_cost)); ?></td>
                        <td><?php echo e(formatAmount($cost->tuesday_cost)); ?></td>
                        <td><?php echo e(formatAmount($cost->wednesday_cost)); ?></td>
                        <td><?php echo e(formatAmount($cost->thursday_cost)); ?></td>
                        <td><?php echo e(formatAmount($cost->friday_cost)); ?></td>
                        <td><?php echo e(formatAmount($cost->saturday_cost)); ?></td>
                        <td><?php echo e(formatAmount($cost->sunday_cost)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>


</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\hall_addons\show_fields.blade.php ENDPATH**/ ?>