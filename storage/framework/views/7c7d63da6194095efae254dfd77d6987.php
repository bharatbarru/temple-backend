<?php $__env->startSection('content'); ?>
<section class="mt-5 checkout-secton">
    <div class="container">
        <h2 class="text-center text-primary text-uppercase mb-0">Checkout</h2>
        <div class="pt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-body shadow mr-5">
                        <h4 class="border-bottom pb-3 text-primary font-700">Order Type</h4>
                        <form id="order-form">
                            <div class="order-type d-flex flex-wrap align-items-center justify-content-center mb-3">
                                <div class="mb-0 font-14">
                                    <label>Select Order Type: <span class="text-primary">*</span></label>
                                </div>
                                <div class="form-check ml-1">
                                    <label class="form-check-label btn btn-primary" for="takeaway">
                                        <input class="form-check-input" type="radio" name="order_type" id="takeaway" value="takeaway" required>
                                        <span>Take Away </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label btn btn-primary" for="home-delivery">
                                        <input class="form-check-input" type="radio" name="order_type" id="home-delivery" value="home-delivery">
                                        <span>Home Delivery</span>
                                    </label>
                                </div>
                            </div>

                            <?php if(auth()->guard('customers')->check()): ?>
                                <?php
                                    $currentCustomer = auth()->guard("customers")->user();
                                ?>
                                <div class="mb-3">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" class="form-control" name="name" value="<?php echo e($currentCustomer->name); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" class="form-control" name="email" value="<?php echo e($currentCustomer->email); ?>" required readonly style="background: #f8f9fa">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone: <span class="text-primary">*</span></label>
                                    <input type="text" id="phone" class="form-control" name="phone" value="<?php echo e($currentCustomer->mobile); ?>" required>
                                </div>
                            <?php else: ?>
                                <div class="mb-3">
                                    <label for="guest_name">Guest Name:</label>
                                    <input type="text" id="guest_name" class="form-control" name="guest_name" required data-parsley-required-message="Guest name is required">
                                </div>
                                <div class="mb-3">
                                    <label for="guest_email">Guest Email:</label>
                                    <input type="email" id="guest_email" class="form-control" name="guest_email" required data-parsley-type="email" data-parsley-required-message="A valid email is required">
                                </div>
                                <div class="mb-3">
                                    <label for="guest_phone">Guest Phone:</label>
                                    <input type="text" id="guest_phone" class="form-control" name="guest_phone" required data-parsley-type="digits" data-parsley-minlength="10" data-parsley-required-message="A valid phone number is required">
                                </div>
                            <?php endif; ?>

                            <!-- Delivery Information (shown only if Home Delivery is selected) -->
                            <div id="delivery-details" style="display: none;">
                                <h4 class="mt-4">Delivery Information</h4>
                                <?php if(applicationSettings('delivery-note')): ?>
                                    <div class="font-14">
                                        <?php echo applicationSettings('delivery-note'); ?>

                                    </div>  
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="delivery-address">Delivery Address:</label>
                                    <textarea id="delivery-address" class="form-control" name="delivery_address" rows="3" data-parsley-required-message="Delivery address is required"><?php echo e(isset($currentCustomer) ? $currentCustomer->address : ''); ?></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6 order-summary">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $subTotal = 0; ?>
                            <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $product = \App\Models\Product::find($productId);
                                    if ($product) {
                                        $price = floatval($product->price);
                                        $amount = $price * $details['quantity'];
                                        $subTotal += $amount;
                                    }
                                ?>
                                <?php if($product): ?>
                                    <tr>
                                        <td><?php echo e($product->title); ?></td>
                                        <td><?php echo e($details['quantity']); ?></td>
                                        <td><?php echo e(formatAmount($price)); ?></td>
                                        <td><?php echo e(formatAmount($amount)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Sub Total:</strong></td>
                                <td><strong id="sub-total"><?php echo e(formatAmount($subTotal)); ?></strong></td>
                            </tr>
                            <tr>
                                <?php
                                    $tax = applicationSettings('tax');
                                ?>
                                <td colspan="3" class="text-end"><strong>Tax (<?php echo e($tax); ?>%):</strong></td>
                                <td><strong id="tax"><?php echo e(formatAmount($subTotal * $tax / 100)); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Delivery Charges:</strong></td>
                                <td><strong id="delivery-charges">$0.00</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Coupon Discount:</strong></td>
                                <td><strong id="coupon-discount">$0.00</strong></td>
                            </tr>
                            <tr id="royalty-points-row" style="display: none;">
                                <td colspan="3" class="text-end"><strong>Royalty Points:</strong></td>
                                <td><strong id="royalty-points">0</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Final Total:</strong></td>
                                <td><strong id="final-total"><?php echo e(formatAmount($subTotal + ($subTotal * $tax / 100))); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if($coupons && $coupons->count() > 0): ?>
                        <div class="mb-3">
                            <label>Available Coupons:</label>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check coupon-check" id="coupon-container-<?php echo e($coupon->id); ?>">
                                    <input type="radio" name="coupon_code" value="<?php echo e($coupon->coupon_code); ?>" 
                                        id="coupon-<?php echo e($coupon->id); ?>" 
                                        class="form-check-input" 
                                        data-discount-type="<?php echo e($coupon->discount_type); ?>"
                                        data-amount="<?php echo e($coupon->discount_value); ?>"
                                        data-max-amount="<?php echo e($coupon->max_amount ?? null); ?>"
                                        data-min-order-amount="<?php echo e($coupon->min_order_amount ?? null); ?>">
                                    <label for="coupon-<?php echo e($coupon->id); ?>" class="form-check-label">
                                        <?php echo e($coupon->coupon_code); ?> - 
                                        <?php echo e($coupon->discount_type == 'fixed' ? formatAmount($coupon->discount_value) : $coupon->discount_value . '% '); ?> 
                                        <?php echo e($coupon->max_amount ? 'Upto ' . formatAmount($coupon->max_amount) : 'Flat'); ?>

                                        <?php echo e($coupon->min_order_amount ? ' (Min order: ' . formatAmount($coupon->min_order_amount) . ')' : ''); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(auth()->guard('customers')->check() && $currentCustomer->getUserRoyaltyPointsRemaining() > 0): ?>
                        <div class="mb-3">
                            <label>Royalty Points:</label>
                            <div class="form-check coupon-check" id="royalty-points-container">
                                <input type="checkbox" name="royalty_points_discount" value="<?php echo e($currentCustomer->getUserRoyaltyPointsRemaining()); ?>" 
                                    id="royalty_points_discount" 
                                    class="form-check-input">
                                <label for="royalty_points_discount" class="form-check-label">
                                    <?php echo e(formatAmount($currentCustomer->getUserRoyaltyPointsRemaining())); ?>

                                </label>
                            </div>
                        </div> 
                    <?php endif; ?>                 

                    <div class="payment-method-block">
                        <h4>Payment Methods</h4>
                        <ul class="list-group mb-3">
                            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <input type="radio" name="payment_method" value="<?php echo e($paymentMethod->id); ?>" id="payment-method-<?php echo e($paymentMethod->id); ?>" data-payment-method-name=<?php echo e($paymentMethod->slug); ?>>
                                    <label for="payment-method-<?php echo e($paymentMethod->id); ?>"><?php echo e($paymentMethod->display_name); ?></label>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <p class="text-danger payment-method-error"></p>
                    </div>

                    <button type="button" class="btn btn-primary" id="complete-order-btn">Complete Order</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Complete Your Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="checkout">
                    <!-- Checkout will insert the payment form here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Add this somewhere in your HTML -->
<div id="loader" style="display: none;">
    <img src="<?php echo e(asset('images/loader.gif')); ?>" alt="Loading..." />
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
<script src="https://js.stripe.com/v3/"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderTypeRadios = document.getElementsByName('order_type');
        const deliveryDetails = document.getElementById('delivery-details');
        const orderForm = document.getElementById('order-form');
        const subTotalElement = document.getElementById('sub-total');
        const taxElement = document.getElementById('tax');
        const deliveryChargesElement = document.getElementById('delivery-charges');
        const couponDiscountElement = document.getElementById('coupon-discount');
        const royaltyPointsCheckbox = document.getElementById('royalty_points_discount');
        const royaltyPointsRow = document.getElementById('royalty-points-row');
        const royaltyPointsDisplay = document.getElementById('royalty-points');  
        const finalTotalElement = document.getElementById('final-total');
        let deliveryCharge = parseFloat("<?php echo e(applicationSettings('delivery-charges')); ?>");
        const noDeliveryChargeAmount = parseFloat("<?php echo e(applicationSettings('no-delivery-charge-amount')); ?>") || Infinity;

        // If deliveryCharge is not a valid number, default it to 0
        if (isNaN(deliveryCharge)) {
            deliveryCharge = 0.00;
        }

        // Order type selection logic (Take Away or Home Delivery)
        orderTypeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'home-delivery') {
                    deliveryDetails.style.display = 'block';
                    $('#delivery-address').prop('required', true);
                    const subTotal = parseFloat(subTotalElement.textContent.replace(/[$,]/g, ''));
                    // Set delivery charges based on the no delivery charge amount
                    const deliveryCharges = subTotal >= noDeliveryChargeAmount ? 0 : deliveryCharge;
                    deliveryChargesElement.textContent = `$${deliveryCharges.toFixed(2)}`;
                } else {
                    deliveryDetails.style.display = 'none';
                    $('#delivery-address').prop('required', false);
                    deliveryChargesElement.textContent = '$0.00';
                }
                calculateRoyaltyPoints();
            });
        });


        function calculateTotal() {
            const subTotal = parseFloat(subTotalElement.textContent.replace(/[$,]/g, ''));
            const points = parseFloat(royaltyPointsDisplay.textContent.replace(/[$,]/g, ''));
            const taxRate = parseFloat("<?php echo e(applicationSettings('tax')); ?>") / 100 || 0; // Default to 0 if NaN
            const tax = subTotal * taxRate;
            const couponDiscount = parseFloat(couponDiscountElement.textContent.replace(/[$,]/g, ''));

            // Get the checked order type, if none are checked, set deliveryCharges to 0
            const orderType = document.querySelector('input[name="order_type"]:checked');
            let deliveryCharges = 0;

            if (orderType && orderType.value === 'home-delivery') {
                // Apply delivery charge only if subTotal is less than noDeliveryChargeAmount
                deliveryCharges = subTotal >= noDeliveryChargeAmount ? 0 : deliveryCharge;
            }

            const royaltyPointsDiscount = royaltyPointsCheckbox && royaltyPointsCheckbox.checked ? points : 0;
            let finalTotal = subTotal + tax + deliveryCharges - royaltyPointsDiscount - couponDiscount;

            taxElement.textContent = `$${tax.toFixed(2)}`;
            finalTotalElement.textContent = `$${finalTotal.toFixed(2)}`;
            deliveryChargesElement.textContent = `$${deliveryCharges.toFixed(2)}`;
            if(finalTotal == 0){
                $('.payment-method-block').hide();
            }
        }

        function calculateRoyaltyPoints() {
            const subTotal = parseFloat(subTotalElement.textContent.replace(/[$,]/g, ''));
            const taxRate = parseFloat("<?php echo e(applicationSettings('tax')); ?>") / 100 || 0; // Default to 0 if NaN
            const tax = subTotal * taxRate;
            const couponDiscount = parseFloat(couponDiscountElement.textContent.replace(/[$,]/g, ''));
            const orderType = document.querySelector('input[name="order_type"]:checked');
            let deliveryCharges = 0;

            if (orderType && orderType.value === 'home-delivery') {
                deliveryCharges = subTotal >= noDeliveryChargeAmount ? 0 : deliveryCharge;
            }

            // Calculate potential final total
            let potentialFinalTotal = subTotal + tax + deliveryCharges - couponDiscount;
            const availableRoyaltyPoints = royaltyPointsCheckbox && royaltyPointsCheckbox.checked ? royaltyPointsCheckbox.value : 0
            const requiredRoyaltyPoints = potentialFinalTotal > availableRoyaltyPoints ? availableRoyaltyPoints : potentialFinalTotal;
            royaltyPointsRow.style.display = ''; // Show if checked
            royaltyPointsDisplay.textContent = '$' + requiredRoyaltyPoints.toFixed(2);
        }

        // Apply Royalty Points discount when checkbox is toggled
        if (royaltyPointsCheckbox) {
            royaltyPointsCheckbox.addEventListener('change', function () {
                // Show or hide the Royalty Points row based on the checkbox state
                if (this.checked) {
                    calculateRoyaltyPoints();
                } else {
                    royaltyPointsRow.style.display = 'none'; // Hide the row
                    royaltyPointsDisplay.textContent = 0;
                }
                calculateTotal(); // Recalculate total whenever the checkbox is toggled
            });

            // Initial call to hide the Royalty Points row if the checkbox is not checked
            if (!royaltyPointsCheckbox.checked) {
                royaltyPointsRow.style.display = 'none';
                royaltyPointsDisplay.textContent = 0;
            } else {
                calculateRoyaltyPoints();
            }
        }

        // Coupon selection and highlighting logic
        const couponRadios = document.getElementsByName('coupon_code');
        couponRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                const discountType = this.dataset.discountType;
                const discountAmount = parseFloat(this.dataset.amount);
                const maxAmount = parseFloat(this.dataset.maxAmount) || Infinity;
                const minOrderAmount = parseFloat(this.dataset.minOrderAmount) || 0;

                let finalTotal = parseFloat(finalTotalElement.textContent.replace(/[$,]/g, ''));
                let subTotal = parseFloat(subTotalElement.textContent.replace(/[$,]/g, '')); // Get subtotal

                if (subTotal >= minOrderAmount) {
                    // Highlight the selected coupon and disable the others only if the coupon is valid
                    couponRadios.forEach(c => {
                        const couponContainer = document.getElementById(`coupon-container-${c.id.split('-')[1]}`);
                        if (c.checked) {
                            couponContainer.classList.add('bg-success', 'text-white');
                        } else {
                            couponContainer.classList.remove('bg-success', 'text-white');
                        }
                        c.disabled = !c.checked; // Disable all except the selected one if the coupon is valid
                    });

                    let discount = 0;

                    if (discountType === 'fixed') {
                        // Flat discount: Coupon discount is subTotal - discountAmount
                        discount = discountAmount;
                    } else if (discountType === 'percentage') {
                        // Percentage discount: Calculate based on maxAmount
                        if (maxAmount !== Infinity && subTotal > maxAmount) {
                            // If maxAmount exists and subTotal is higher than maxAmount
                            discount = maxAmount * (discountAmount / 100);
                        } else {
                            // No maxAmount or subTotal within maxAmount limit
                            discount = subTotal * (discountAmount / 100);
                        }
                    }

                    // Ensure discount does not exceed the subtotal
                    if (discount > subTotal) {
                        discount = subTotal;
                    }

                    couponDiscountElement.textContent = `$${discount.toFixed(2)}`;
                    finalTotal = subTotal - discount;

                    toastr.success('Coupon applied successfully!', 'Success');
                } else {
                    // Do not disable radio buttons if coupon is not applied
                    couponRadios.forEach(c => {
                        const couponContainer = document.getElementById(`coupon-container-${c.id.split('-')[1]}`);
                        couponContainer.classList.remove('bg-success', 'text-white');
                        c.disabled = false; // Keep all radio buttons enabled
                    });

                    couponDiscountElement.textContent = '$0.00';
                    toastr.error('Order amount is less than the minimum required for this coupon.', 'Coupon Not Applied');
                    //remove checked
                    $('input[name="coupon_code"]').prop('checked', false);
                }

                finalTotalElement.textContent = `$${finalTotal.toFixed(2)}`;
            });
        });


        const completeOrderButton = document.getElementById('complete-order-btn');
        completeOrderButton.addEventListener('click', function () {
            if (!$('#order-form').parsley().validate()) {
                $('#order-form').parsley().validate();
                return;
            }
            // Clear previous error message
            document.querySelector('.payment-method-error').textContent = '';

            // Check if a payment method is selected
            const paymentMethodChecked = document.querySelector('input[name="payment_method"]:checked');
            const fTotal = parseFloat(finalTotalElement.textContent.replace(/[$,]/g, ''));
            if (!paymentMethodChecked && fTotal > 0) {
                // Display error in the payment-method-error paragraph
                document.querySelector('.payment-method-error').textContent = 'Please select a payment method.';
                return;  // Stop form submission
            }

            // Gather form data
            const formData = new FormData(orderForm);
            const orderType = document.querySelector('input[name="order_type"]:checked').value;
            const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');
            const paymentMethod = paymentMethodInput ? paymentMethodInput.value : '';
            const paymentMethodName = paymentMethodInput ? paymentMethodInput.getAttribute('data-payment-method-name') : '';
            const couponApplied = document.querySelector('input[name="coupon_code"]:checked') ? 
                                  document.querySelector('input[name="coupon_code"]:checked').value : null;
                                  console.log(couponApplied);
            const deliveryAddress = orderType === 'home-delivery' ? document.getElementById('delivery-address').value : null;
            const taxElement = document.getElementById('tax');

            const royaltyPointsValue = royaltyPointsCheckbox && royaltyPointsCheckbox.checked ? parseFloat(royaltyPointsCheckbox.value) : 0;
            
            // Add additional data to the form data
            formData.append('order_type', orderType);
            formData.append('name', $('#name').val());
            formData.append('email', $('#email').val());
            formData.append('phone', $('#phone').val());
            formData.append('guest_name', $('#guest_name').val());
            formData.append('guest_email', $('#guest_email').val());
            formData.append('guest_phone', $('#guest_phone').val());
            formData.append('payment_method', paymentMethod);
            formData.append('coupon', couponApplied);
            formData.append('delivery_address', deliveryAddress);
            formData.append('sub_total', subTotalElement.textContent.replace(/[$,]/g, ''));
            formData.append('tax', taxElement.textContent.replace(/[$,]/g, ''));
            formData.append('delivery_charges', deliveryChargesElement.textContent.replace(/[$,]/g, ''));
            formData.append('coupon_discount', couponDiscountElement.textContent.replace(/[$,]/g, ''));
            formData.append('final_total', finalTotalElement.textContent.replace(/[$,]/g, ''));
            formData.append('royalty_points', royaltyPointsValue);

            // Check if payment method is Stripe
            if (paymentMethodName === 'stripe') {
                const stripe = Stripe('<?php echo e(getStripeKey()); ?>');
                async function initialize() {
                    const fetchClientSecret = async () => {
                        const response = await fetch("/checkout", {
                            method: "POST",
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', // Include CSRF token for Laravel
                            },
                        });
                        const { client_secret } = await response.json();
                        return client_secret;
                    };

                    const checkout = await stripe.initEmbeddedCheckout({
                        fetchClientSecret,
                    });

                    // Mount Checkout
                    checkout.mount('#checkout');
                    $('#checkoutModal').modal('show');
                }
                initialize();
            } else {
                // Handle non-Stripe payment methods
                $('#loader').show();
                fetch('/checkout', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', // Include CSRF token for Laravel
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#loader').hide();
                        window.location.href = '/order-confirmation'; // Change this to your success page
                    } else {
                        // Handle errors
                        alert(data.message || 'An error occurred. Please try again.1');
                    }
                })
                .catch(error => {
                    $('#loader').hide();
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.2');
                });
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\orders\checkout.blade.php ENDPATH**/ ?>