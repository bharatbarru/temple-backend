<?php $__env->startSection('content'); ?>
 <div class="card callout-success-bg puja-card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Puja Info
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
            <h5 class="col-md-4 text-primary">Puja Request ID:</h5>
            <h5 class="col-md-8 text-primary" style="font-weight:bold"><?php echo e($order->puja_request_id); ?></h5>
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
    </div> 
</div> 


    <!-- User Info Card -->
    <div class="card callout callout-info puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">USER INFO</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Payment Status</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->payment_status ?? 'N/A'); ?></p>

                <p class="col-md-4">Name</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->first_name . ' ' . $order->last_name ?? 'N/A'); ?></p>

                <p class="col-md-4">Address</p>
                <p class="col-md-8 font-weight-bold">
                    <?php echo e(implode(', ', array_filter([
                        $order->address,
                        $order->city,
                        $order->state_name,
                        $order->pincode,
                        $order->country_name
                    ], fn($value) => !is_null($value) && $value !== ''))); ?>

                </p>

                <p class="col-md-4">Contact No</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->contact_no ?? 'N/A'); ?></p>

                <p class="col-md-4">Email</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->email ?? 'N/A'); ?></p>
            </div>
        </div>
    </div>

    <!-- Requested Puja Info Card -->
    <div class="card callout callout-info puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">REQUESTED PUJA INFO</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Date of Puja</p>
                <p class="col-md-8 font-weight-bold">
                    <?php echo e(formatDate($order->date_of_puja) ?? 'N/A'); ?> @ 
                    <?php echo e(formatTime($order->from_time_of_puja)); ?> - <?php echo e(formatTime($order->to_time_of_puja)); ?>

                </p>

                <?php if($order->request_status != "RESCHEDULE_REQUEST"): ?>
                    <p class="col-md-4">Alternate Date of Puja</p>
                    <p class="col-md-8 font-weight-bold">
                        <?php echo e(implode(' / ', array_filter([
                            $order->alternate_date_of_puja_1 != '1970-01-01' ? formatDate($order->alternate_date_of_puja_1) : null,
                            $order->alternate_date_of_puja_2 != '1970-01-01' ? formatDate($order->alternate_date_of_puja_2) : null,
                        ], fn($value) => !is_null($value) && $value !== ''))); ?>

                    </p>
                <?php endif; ?>

                <p class="col-md-4">Name Of Requestor</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->name_of_requestor); ?></p>

                <p class="col-md-4">Comments</p>
                <p class="col-md-8 font-weight-bold"><?php echo e($order->comment); ?></p>
            </div>
        </div>
    </div>

    <!-- Puja/Service Card -->
    <div class="card callout callout-danger puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">PUJA / SERVICE</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4"><b>Name</b></p>
                <p class="col-md-8 font-weight-bold"><b>Charge Amount</b></p>

                <?php $__currentLoopData = $pujas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $puja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="col-md-4"><?php echo e($puja->puja_name); ?></p>
                    <p class="col-md-8 font-weight-bold"><?php echo e(formatAmount($puja->amount)); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <p class="col-md-4"><b>Total Amount</b></p>
                <p class="col-md-8 font-weight-bold"><b><?php echo e(formatAmount($order->total_amount)); ?></b></p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\old-puja-requests\show.blade.php ENDPATH**/ ?>