<!-- Orderid Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('orderid', 'Orderid:'); ?>

    <?php echo Form::text('orderid', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('customer_id', 'Customer Id:'); ?>

    <?php echo Form::number('customer_id', null, ['class' => 'form-control']); ?>

</div>

<!-- Guest Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('guest_name', 'Guest Name:'); ?>

    <?php echo Form::text('guest_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Guest Email Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('guest_email', 'Guest Email:'); ?>

    <?php echo Form::text('guest_email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Guest Phone Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('guest_phone', 'Guest Phone:'); ?>

    <?php echo Form::text('guest_phone', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Order Type Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('order_type', 'Order Type:'); ?>

    <?php echo Form::text('order_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Subtotal Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('subtotal_amount', 'Subtotal Amount:'); ?>

    <?php echo Form::number('subtotal_amount', null, ['class' => 'form-control']); ?>

</div>

<!-- Coupon Discount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('coupon_discount', 'Coupon Discount:'); ?>

    <?php echo Form::number('coupon_discount', null, ['class' => 'form-control']); ?>

</div>

<!-- Royalty Points Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('royalty_points_amount', 'Royalty Points Amount:'); ?>

    <?php echo Form::number('royalty_points_amount', null, ['class' => 'form-control']); ?>

</div>

<!-- Tax Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('tax_amount', 'Tax Amount:'); ?>

    <?php echo Form::number('tax_amount', null, ['class' => 'form-control']); ?>

</div>

<!-- Delivery Charge Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('delivery_charge', 'Delivery Charge:'); ?>

    <?php echo Form::number('delivery_charge', null, ['class' => 'form-control']); ?>

</div>

<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('total_amount', 'Total Amount:'); ?>

    <?php echo Form::number('total_amount', null, ['class' => 'form-control']); ?>

</div>

<!-- Coupon Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('coupon_id', 'Coupon Id:'); ?>

    <?php echo Form::number('coupon_id', null, ['class' => 'form-control']); ?>

</div>

<!-- Delivery Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('delivery_address', 'Delivery Address:'); ?>

    <?php echo Form::textarea('delivery_address', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Contact Number Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('contact_number', 'Contact Number:'); ?>

    <?php echo Form::text('contact_number', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Payment Method Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('payment_method_id', 'Payment Method Id:'); ?>

    <?php echo Form::number('payment_method_id', null, ['class' => 'form-control']); ?>

</div>

<!-- Transaction Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('transaction_id', 'Transaction Id:'); ?>

    <?php echo Form::text('transaction_id', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Payment Status Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('payment_status', 'Payment Status:'); ?>

    <?php echo Form::text('payment_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Order Status Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('order_status', 'Order Status:'); ?>

    <?php echo Form::text('order_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Reason For Cancellation Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('reason_for_cancellation', 'Reason For Cancellation:'); ?>

    <?php echo Form::textarea('reason_for_cancellation', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]); ?>

</div>

<!-- Order Date Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('order_date', 'Order Date:'); ?>

    <?php echo Form::text('order_date', null, ['class' => 'form-control','id'=>'order_date']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#order_date').datepicker()
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\orders\fields.blade.php ENDPATH**/ ?>