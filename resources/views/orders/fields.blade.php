<!-- Orderid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('orderid', 'Orderid:') !!}
    {!! Form::text('orderid', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    {!! Form::number('customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Guest Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guest_name', 'Guest Name:') !!}
    {!! Form::text('guest_name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Guest Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guest_email', 'Guest Email:') !!}
    {!! Form::text('guest_email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Guest Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guest_phone', 'Guest Phone:') !!}
    {!! Form::text('guest_phone', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Order Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_type', 'Order Type:') !!}
    {!! Form::text('order_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Subtotal Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subtotal_amount', 'Subtotal Amount:') !!}
    {!! Form::number('subtotal_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Discount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_discount', 'Coupon Discount:') !!}
    {!! Form::number('coupon_discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Royalty Points Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('royalty_points_amount', 'Royalty Points Amount:') !!}
    {!! Form::number('royalty_points_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax_amount', 'Tax Amount:') !!}
    {!! Form::number('tax_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Charge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_charge', 'Delivery Charge:') !!}
    {!! Form::number('delivery_charge', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::number('total_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_id', 'Coupon Id:') !!}
    {!! Form::number('coupon_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('delivery_address', 'Delivery Address:') !!}
    {!! Form::textarea('delivery_address', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Contact Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_number', 'Contact Number:') !!}
    {!! Form::text('contact_number', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Payment Method Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_method_id', 'Payment Method Id:') !!}
    {!! Form::number('payment_method_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    {!! Form::text('transaction_id', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Payment Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    {!! Form::text('payment_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Order Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_status', 'Order Status:') !!}
    {!! Form::text('order_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Reason For Cancellation Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reason_for_cancellation', 'Reason For Cancellation:') !!}
    {!! Form::textarea('reason_for_cancellation', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Order Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_date', 'Order Date:') !!}
    {!! Form::text('order_date', null, ['class' => 'form-control','id'=>'order_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#order_date').datepicker()
    </script>
@endpush