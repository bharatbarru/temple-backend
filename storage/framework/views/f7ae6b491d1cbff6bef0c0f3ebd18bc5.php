<?php $__env->startSection('content'); ?>
    <section class="confirm">
        <div class="container">
            <h1 class="mt-5 mb-3  text-uppercase text-primary text-center">View Order</h1>

            <div>
                <ul class="list-group mb-5">
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span> Order ID</span> :
                    <?php echo e($order->orderid); ?>

                    </li>

                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span > Order Type </span>: 
                    <?php echo e(ucfirst($order->order_type)); ?>

                    </li>

                    <?php if($order->order_type == 'home-delivery'): ?>
                        <li class="list-group-item d-flex justify-content-start align-items-center">
                            <span > Delivery Address </span>:
                        <?php echo e($order->delivery_address); ?>

                        </li>
                    <?php endif; ?>

                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span > Payment Method </span>: 
                    <?php echo e($order->paymentMethod->display_name ?? 'Paid Through Wallet'); ?>

                    </li>

                    <?php if($order->paymentMethod && $order->paymentMethod->slug == 'stripe'): ?>
                        <li class="list-group-item d-flex justify-content-start align-items-center">
                            <span > Transaction ID </span>:
                        <?php echo e($order->transaction_id); ?>

                        </li>
                    <?php endif; ?>
        
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span > Payment Status </span>: 
                    <?php echo e($order->payment_status); ?>

                    </li>
        
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span > Order Status </span>: 
                    <?php echo e($order->order_status); ?>

                    </li>
        
                    <?php if($order->order_status == 'declined'): ?>
                        <li class="list-group-item d-flex justify-content-start align-items-center">
                            <span > Reason for Cancellation </span>:
                        <?php echo e($order->reason_for_cancellation); ?>

                        </li>
                    <?php endif; ?>
                    
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span >  <b>Total Amount</b></span>
                        <b>   :  <?php echo e(formatAmount($order->total_amount)); ?></b>
                    </li>
                </ul>
            </div>

            <h4 class="mt-5">Order Summary</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order->orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($orderProduct->product->title); ?></td>
                            <td><?php echo e($orderProduct->quantity); ?></td>
                            <td><?php echo e(formatAmount($orderProduct->price)); ?></td>
                            <td><?php echo e(formatAmount(($orderProduct->quantity*$orderProduct->price))); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Sub Total</th>
                        <th><?php echo e(formatAmount($order->subtotal_amount)); ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Tax (<?php echo e(applicationSettings('tax')); ?>%)</th>
                        <th><?php echo e(formatAmount($order->tax_amount)); ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Delivery Charges</th>
                        <th><?php echo e(formatAmount($order->delivery_charge)); ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Coupon Discount</th>
                        <th><?php echo e(formatAmount($order->coupon_discount)); ?></th>
                    </tr>
                    <?php if($order->royalty_points_amount): ?>
                        <tr>
                            <th colspan="3" class="text-right">Royalty Points Discount</th>
                            <th><?php echo e(formatAmount($order->royalty_points_amount)); ?></th>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th colspan="3" class="text-right">Final Amount</th>
                        <th><?php echo e(formatAmount($order->total_amount)); ?></th>
                    </tr>
                </tfoot>
            </table>

            <a href="<?php echo e(url('/orders')); ?>" class="btn btn-primary mt-3">Back to Orders</a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\customers\view-order.blade.php ENDPATH**/ ?>