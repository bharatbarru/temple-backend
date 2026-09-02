<?php $__env->startSection('content'); ?>
  <div class="card callout-success-bg puja-card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Hall Info
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-danger float-right" style="color: #fff; text-decoration:none"
                    href="javascript:history.back()">
                    Back
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <h5 class="col-md-4 text-primary">Hall Request ID:</h5>
            <h5 class="col-md-8 text-primary" style="font-weight:bold"><?php echo e($order->hall_request_id); ?></h5>
        </div>

        <div class="color-pallate">
            <div class="mb-5">
                <span class="color-code-span">Color Code:</span>
                <span>
                    <badge class="new-request">&nbsp;</badge> New Request
                </span>
                <span>
                    <badge class="reschedule-request">&nbsp;</badge> Reschedule Request
                </span>
                <span>
                    <badge class="cancellation-request">&nbsp;</badge> Cancellation Request
                </span>
            </div>

            <div class="order-status">
                <h3>Order Status</h3>
                <?php
                    $statusClass = '';
                    $statusText = '';

                    switch ($order->request_status) {
                        case 'PENDING':
                            $statusClass = 'new-request';
                            $statusText = 'New Request';
                            break;
                        case 'RESCHEDULE_REQUEST':
                            $statusClass = 'reschedule-request';
                            $statusText = 'Reschedule Request';
                            break;
                        case 'CANCEL_REQUEST':
                            $statusClass = 'cancellation-request';
                            $statusText = 'Cancellation Request';
                            break;
                        default:
                            $statusText = $order->request_status;
                    }
                ?>

                <span class="status-label <?php echo e($statusClass); ?>"><?php echo e($statusText); ?></span>
            </div>
        </div>
    </div> <!-- Closing card-body div -->
</div> <!-- Closing card div -->


    <!-- User Info Card -->
    <div class="card callout callout-info puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">USER INFO</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Payment Status</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->payment_status ?? 'N/A'); ?></p>

                <p class="col-md-4">Individual / Community Name</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->first_name . ' ' . $order->last_name ?? 'N/A'); ?></p>

                <p class="col-md-4">Primary Phone</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->primary_phone ?? 'N/A'); ?></p>

                <p class="col-md-4">Email</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->email ?? 'N/A'); ?></p>
            </div>
        </div>
    </div>

    <!-- Requested Puja Info Card -->
    <div class="card callout callout-info puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">REQUESTED HALL BOOKING INFO</h1>
        </div>
        <div class="card-body"> 
            <div class="row">
                <p class="col-md-4">Date of Event</p>
                <p class="col-md-8 font-weight-bold">
                    <?php echo e(formatDate($order->date_of_event)); ?> @
                    <?php echo e(formatTime($order->start_time)); ?>

                </p>

                <?php if($order->request_status == "PENDING"): ?>
                    <p class="col-md-4">Alternate Date of Event</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e(formatDate($order->alternate_date_of_event)); ?></p>
                <?php endif; ?>

                <p class="col-md-4">Comment/Special Instruction</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->comment); ?></p>
            </div>
        </div>
    </div>

    <!-- Puja/Service Card -->
    <div class="card callout callout-danger puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">PACKAGE / ADDONS</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4"><b>Name</b></p>
                <p class="col-md-8 font-weight-bold"><b>Charge Amount</b></p>

                <p class="col-md-4"><b>PACKAGE</b></p>
                <p class="col-md-8 font-weight-bold"><b></b></p>

                <p class="col-md-4">
                    <?php echo e($order->package_type_name); ?> -
                    <span style="color: #cc0000"><?php echo e($order->package_name); ?></span>
                </p>
                <p class="col-md-8 font-weight-bold"><?php echo e(formatAmount($order->total_amount)); ?></p>

                <p class="col-md-4"><b>Total Amount</b></p>
                <p class="col-md-8 font-weight-bold"><b><?php echo e(formatAmount($order->total_amount)); ?></b></p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\old_hallrequests\show.blade.php ENDPATH**/ ?>