<!-- Coupon Code Field -->
<div class="form-group col-sm-4">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    {!! Form::text('coupon_code', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($coupon) ? $coupon->image : null, 'path' => COUPON_IMAGE_PATH])

<!-- Discount Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('discount_type', 'Discount Type:') !!}
    <div>
        <label>
            {!! Form::radio('discount_type', 'fixed', isset($coupon) && $coupon->discount_type == 'fixed', ['id' => 'discount_type_fixed', 'required']) !!} Fixed
        </label>
        <label style="margin-left: 10px;">
            {!! Form::radio('discount_type', 'percentage', isset($coupon) && $coupon->discount_type == 'percentage', ['id' => 'discount_type_percentage']) !!} Percentage
        </label>
    </div>
</div>

<!-- Percentage Type (Flat or Upto) -->
<div class="form-group col-sm-4" id="percentage_type_field" style="display: none;">
    {!! Form::label('percentage_type', 'Percentage Type:') !!}
    <div>
        <label>
            {!! Form::radio('percentage_type', 'flat', false, ['id' => 'percentage_type_flat']) !!} Flat
        </label>
        <label style="margin-left: 10px;">
            {!! Form::radio('percentage_type', 'upto', false, ['id' => 'percentage_type_upto']) !!} Upto
        </label>
    </div>
</div>

<!-- Max Amount Field -->
<div class="form-group col-sm-4" id="max_amount_field" style="display: none;">
    {!! Form::label('max_amount', 'Max Amount:') !!}
    {!! Form::text('max_amount', isset($coupon) ? $coupon->max_amount : null, ['class' => 'form-control digits-input', 'id' => 'max_amount']) !!}
</div>

<!-- Discount Value Field (Enter Amount or Percentage) -->
<div class="form-group col-sm-4" id="discount_value_field" style="display: none;">
    {!! Form::label('discount_value_label', 'Enter Amount:', ['id' => 'discount_value_label']) !!}
    {!! Form::text('discount_value', null, ['class' => 'form-control digits-input', 'required']) !!}
</div>

<!-- Min Order Amount Field -->
<div class="form-group col-sm-4">
    {!! Form::label('min_order_amount', 'Min Order Amount:') !!}
    {!! Form::text('min_order_amount', null, ['class' => 'form-control digits-input', 'required', 'required']) !!}
</div>

<!-- Valid From Field -->
<div class="form-group col-sm-4">
    {!! Form::label('valid_from', 'Valid From:') !!}
    {!! Form::text('valid_from', isset($coupon) ? formatDate($coupon->valid_from) : null, ['class' => 'form-control dateonlypicker','id'=>'valid_from', 'required']) !!}
</div>

<!-- Valid Until Field -->
<div class="form-group col-sm-4">
    {!! Form::label('valid_until', 'Valid Until:') !!}
    {!! Form::text('valid_until', isset($coupon) ? formatDate($coupon->valid_until) : null, ['class' => 'form-control dateonlypicker','id'=>'valid_until', 'required']) !!}
</div>

<!-- Usage Limit Field -->
<div class="form-group col-sm-4">
    {!! Form::label('usage_limit', 'Usage Limit:') !!}
    {!! Form::text('usage_limit', null, ['class' => 'form-control digits-input', 'required']) !!}
</div>

@push('page_scripts')
    <script>
        function toggleDiscountFields() {
            let discountType = $('input[name="discount_type"]:checked').val();
            let percentageType = $('input[name="percentage_type"]:checked').val();
            
            if (discountType === 'percentage') {
                $('#percentage_type_field').show();
                $('#discount_value_field').show();
                $('#discount_value_label').text('Enter Percentage:');

                // Make percentage type required when discount type is percentage
                $('input[name="percentage_type"]').attr('required', true);
                $('#discount_value_field input').attr('maxlength', 2);

                // Show max amount if 'upto' is selected and make it required
                if (percentageType === 'upto') {
                    $('#max_amount_field').show();
                    $('#max_amount').attr('required', true);  // Make max amount required
                } else {
                    $('#max_amount_field').hide();
                    $('#max_amount').removeAttr('required');  // Remove required attribute if not 'upto'
                }
            } else if (discountType === 'fixed') {
                $('#percentage_type_field').hide();
                $('#max_amount_field').hide();
                $('#discount_value_field').show();
                $('#discount_value_label').text('Enter Amount:');
                
                // Remove required attribute from percentage type if fixed discount is selected
                $('input[name="percentage_type"]').removeAttr('required');
                $('#max_amount').removeAttr('required');  // Remove required attribute if fixed
                $('#discount_value_field input').removeAttr('maxlength'); // Remove required attribute if fixed
            } else {
                // Hide fields if no discount type is selected
                $('#percentage_type_field').hide();
                $('#max_amount_field').hide();
                $('#discount_value_field').hide();
                
                // Remove required attribute from both percentage type and max amount
                $('input[name="percentage_type"]').removeAttr('required');
                $('#max_amount').removeAttr('required');  // Ensure max amount is not required when hidden
            }
        }

        $(document).ready(function() {
            // Check if coupon exists (edit mode)
            let isEditMode = {!! isset($coupon) ? 'true' : 'false' !!};
            let maxAmount = {!! isset($coupon) && $coupon->max_amount ? 'true' : 'false' !!};

            // Initially hide fields
            toggleDiscountFields();

            // On edit, pre-select the appropriate percentage type if max_amount exists
            if (isEditMode && $('input[name="discount_type"]:checked').val() === 'percentage') {
                $('#percentage_type_field').show();
                $('#discount_value_field').show();
                if (maxAmount) {
                    $('#percentage_type_upto').prop('checked', true);
                    $('#max_amount_field').show();
                    $('#max_amount').attr('required', true);  // Make max amount required if in edit mode
                } else {
                    $('#percentage_type_flat').prop('checked', true);
                    $('#max_amount_field').hide();
                    $('#max_amount').removeAttr('required');  // Ensure max amount is not required if 'flat'
                }
            }

            // Toggle fields on discount type change
            $('input[name="discount_type"]').change(function() {
                toggleDiscountFields();
            });

            // Toggle fields on percentage type change
            $('input[name="percentage_type"]').change(function() {
                toggleDiscountFields();
            });

            // Attach validation function to form submit
            $('form').submit(function(event) {
                validateForm(event);
            });
        });

        function validateForm(event) {
            let discountType = $('input[name="discount_type"]:checked').val();
            let discountValue = parseFloat($('input[name="discount_value"]').val()); // This is the fixed discount amount
            let minOrderAmount = parseFloat($('input[name="min_order_amount"]').val());

            // Check if discount type is fixed and ensure min order amount is greater than or equal to the fixed discount value
            if (discountType === 'fixed') {
                if (minOrderAmount <= discountValue) {
                    alert("Min Order Amount must be greater than Discount Amount.");
                    event.preventDefault(); // Prevent form submission
                    return false;
                }
            }
        }
    </script>
@endpush
