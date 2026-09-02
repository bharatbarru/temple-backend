<!-- Name Field -->
<div class="col-sm-6">


    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('name', 'Name:'); ?> <span class="float-right "><?php echo e($customer->name); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('email', 'Email:'); ?><span class="float-right "><?php echo e($customer->email); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('mobile', 'Mobile:'); ?><span class="float-right "><?php echo e($customer->mobile); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <label for="display_name"><?php echo Form::label('address', 'Address:'); ?></label><span class="float-right "><?php echo e($customer->address); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <label for="display_name"><?php echo Form::label('pincode', 'Pincode:'); ?></label><span class="float-right "><?php echo e($customer->pincode); ?></span>
        </li>
     
        <li class="nav-item">
            <label for="slug"><?php echo Form::label('publish', 'Publish:'); ?></label>
            <span class="float-right"><?php echo e($customer->publish); ?></span>
        </li>
      
        </ul>






</div>


<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\customers\show_fields.blade.php ENDPATH**/ ?>