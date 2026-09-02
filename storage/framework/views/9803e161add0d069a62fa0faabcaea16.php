<?php $__env->startSection('content'); ?>
    <section class="pt-5">
        <div class="container">
            <div class="pt-6">
                <h2 class="text-center text-primary text-uppercase mb-5">Orders</h2>

                <div class="hide-mobile">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th class="text-light" scope="col">#</th>
                                    <th class="text-light" scope="col">Order ID</th>
                                    <th class="text-light" scope="col">Order Type</th>
                                    <th class="text-light" scope="col">Payment Method</th>
                                    <th class="text-light" scope="col">Total Amount</th>
                                    <th class="text-light" scope="col">Payment Status</th>
                                    <th class="text-light" scope="col">Order Status</th>
                                    <th class="text-light" scope="col">Order Date</th>
                                    <th class="text-light" scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($orders->count() > 0): ?>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($i + 1); ?></th>
                                            <td><?php echo e($order->orderid); ?></td>
                                            <td><?php echo e($order->order_type); ?></td>
                                            <td><?php echo e($order->paymentMethod->display_name ?? 'Paid Through Wallet'); ?></td>
                                            <td><?php echo e(formatAmount($order->total_amount)); ?></td>
                                            <td><?php echo e($order->payment_status); ?></td>
                                            <td><?php echo e($order->order_status); ?></td>
                                            <td><?php echo e(formatDate($order->created_at)); ?></td>
                                            <td><a href="<?php echo e(url('view-order/' . $order->id)); ?>" class="btn-sm btn-primary">View</a></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th colspan="9" class="text-center">No data found</th>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\customers\orders.blade.php ENDPATH**/ ?>