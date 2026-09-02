<?php $__env->startSection('title', 'Your Cart'); ?>

<?php $__env->startSection('content'); ?>
    <section class="pt-5">
        <div class="container">
            <div class="pt-6 shopping-cart">
                <h2 class="text-center text-primary text-uppercase mb-5">Your Shopping Cart</h2>
                <?php if(session('cart') && count(session('cart')) > 0): ?>

                <div class="table-responsive cart-table">
                    <table class="table table-bordered table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th align="center" style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    // Fetch product details from the database using the product ID
                                    $product = \App\Models\Product::find($productId);

                                    // Handle case where product no longer exists
                                    if ($product) {
                                        // Convert price from varchar to float for calculation
                                        $price = floatval($product->price);
                                        $subtotal = $price * $details['quantity'];
                                        $total += $subtotal;
                                    }
                                ?>
                                <?php if($product): ?>
                                    <tr>
                                        <td data-label="Product"><?php echo e($product->title); ?></td>
                                        <td data-label="Quantity"><?php echo e($details['quantity']); ?></td>
                                        <td data-label="Price"> <?php echo e(formatAmount($price)); ?> </td>
                                        <td  data-label="Subtotal"><?php echo e(formatAmount($subtotal)); ?></td>
                                        <td data-label="Action"  align="center">
                                            <button type="button" class="btn btn-remove btn-sm remove-from-cart" data-id="<?php echo e($productId); ?>">
                                                <span class="material-symbols-outlined">
                                                    delete_forever
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">Product no longer available.</td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="3" class="text-end hide-mobile"><strong>Total:</strong></td>
                                <td colspan="2" data-label="Total"><strong> <?php echo e(formatAmount($total)); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart-buttons">

                    
                    <a href="<?php echo e(url('/online-order')); ?>" class="btn btn-warning ">Continue Shopping</a>
                    <button type="button" class="btn btn-primary float-right" id="checkout-btn">Proceed to Checkout</button>
                </div>



                <?php else: ?>
                    <div class="p-5 text-center">
                        <p>Your cart is empty.</p>
                        <a href="<?php echo e(url('/online-order')); ?>" class="btn btn-secondary">Continue Shopping</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Login or continue as a guest</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="text-center sign-login">
                        <?php echo $__env->make('customers-auth.social-login-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <button type="button" class="btn btn-secondary" id="guest-checkout">Checkout as Guest</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if the user is logged in (server-side boolean injected via Blade)
            const isLoggedIn = <?php echo e(auth()->guard('customers')->check() ? 'true' : 'false'); ?>;

            // Handle checkout button click
            document.getElementById('checkout-btn').addEventListener('click', function () {
                if (isLoggedIn) {
                    // If user is logged in, redirect to the checkout page
                    window.location.href = '<?php echo e(url("/checkout")); ?>';
                } else {
                    // Otherwise, show the login/guest modal
                    const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
                    checkoutModal.show(); 
                }
            });

            // Handle guest checkout button click
            document.getElementById('guest-checkout').addEventListener('click', function () {
                // Redirect to the guest checkout page
                window.location.href = '<?php echo e(url("/checkout")); ?>';
            });

            // Handle removing items from cart
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-id');
                    removeFromCart(productId);
                });
            });

            function removeFromCart(productId) {
                fetch('<?php echo e(url("/remove-from-cart")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload to reflect changes
                        toastr.success('Removed from cart successfully', 'Success');
                    } else {
                        toastr.error(data.message, 'Error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An error occurred while removing the item from the cart.', 'Error');
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\orders\cart.blade.php ENDPATH**/ ?>