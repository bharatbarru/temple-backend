<!-- Payment Method Name Field -->
<div class="col-sm-6">



    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('payment_method_name', 'Payment Method Name:'); ?> <span class="float-right "><?php echo e($paymentMethod->payment_method_name); ?></span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <?php echo Form::label('display_name', 'Display Name:'); ?><span class="float-right "><?php echo e($paymentMethod->display_name); ?></span>
        </li>
        <li class="nav-item">
            <?php echo Form::label('slug', 'Slug:'); ?>

            <span class="float-right"><?php echo e($paymentMethod->slug); ?></span>
        </li>
      
        </ul>

</div>

<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\payment_methods\show_fields.blade.php ENDPATH**/ ?>