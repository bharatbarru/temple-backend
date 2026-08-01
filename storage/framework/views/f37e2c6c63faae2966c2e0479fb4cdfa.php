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
            <h5 class="col-md-8 text-primary" style="font-weight:bold"><?php echo e($pujaOrder->puja_request_id); ?></h5>
        </div>

        <div class="color-pallate">
            <div class="mb-5">
                <span class="color-code-span">Color Code:</span> <span>
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
                <ul>
                    <?php $__currentLoopData = $pujaOrder->orderStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e($status->status == 'NEW REQUEST' ? 'new-request' : 
                            ($status->status == 'RESCHEDULE REQUEST' ? 'reschedule-request' : 
                            ($status->status == 'CANCEL REQUEST' ? 'cancellation-request' : ''))); ?>"><?php echo e($status->status); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card callout callout-info puja-card">  
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    User Info
                </h1>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">Name: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->user->first_name . ' ' . $pujaOrder->user->last_name); ?></p>

            <p class="col-md-4">Address: </p>
            <p class="col-md-8 font-weight-bold">
                <?php echo e(implode(', ', array_filter([
                    $pujaOrder->user->address,
                    $pujaOrder->user->city,
                    $pujaOrder->user->state,
                    $pujaOrder->user->pincode,
                    $pujaOrder->user->country
                ], fn($value) => !is_null($value) && $value !== ''))); ?>

            </p>

            <p class="col-md-4">Contact No</p>
            <p class="col-md-8 font-weight-bold"><?php echo e($pujaOrder->user->mobile); ?></p>

            <p class="col-md-4">Email</p>
            <p class="col-md-8 font-weight-bold"><?php echo e($pujaOrder->user->email); ?></p>


        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php
    $statuses = $pujaOrder->orderStatuses->pluck('status')->toArray();
?>

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Requested Puja Info
                </h1>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">
                Date Of Puja:
                <?php if(in_array(RESCHEDULE_REQUEST, $statuses)): ?>
                    <span class="badge badge-primary">Rescheduled</span>
                <?php endif; ?>
            </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e(formatDate($pujaOrder->date_of_puja)); ?></p>

            <p class="col-md-4">
                Time Of Puja:
                <?php if(in_array(RESCHEDULE_REQUEST, $statuses)): ?>
                    <span class="badge badge-primary">Rescheduled</span>
                <?php endif; ?>
            </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->time_of_puja); ?></p>


            <p class="col-md-4">Alternate Date Of Puja1: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e(formatDate($pujaOrder->alternate_date_of_puja1)); ?></p>

            <p class="col-md-4">Alternate Time Of Puja1: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->alternate_time_of_puja2); ?></p>

            <p class="col-md-4">Comment/Special Instruction: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->comments); ?></p>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php if(in_array(RESCHEDULE_REQUEST, $statuses)): ?>
    <div class="card callout callout-warning puja-card">
        <div class="card-header ">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="card-title" style="font-size:24px">
                        Rescheduled Info
                    </h1>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Changed By: </p>
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->changed_by); ?></p>

                <p class="col-md-4">Changed Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->changed_comments); ?></p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
<?php endif; ?>

<?php if(in_array(CANCEL_REQUEST, $statuses)): ?>
    <div class="card callout callout-danger puja-card">
        <div class="card-header ">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="card-title" style="font-size:24px">
                        Cancelled Info
                    </h1>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Cancelled By: </p>
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->cancelled_by); ?></p>

                <p class="col-md-4">Cancelled Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($pujaOrder->cancelled_comments); ?></p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
<?php endif; ?>

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Puja / Service
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Charge Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pujaOrder->pujaOrderLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pujaOrderList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($pujaOrderList->puja->name); ?></td>
                                <td><?php echo e(formatAmount($pujaOrderList->puja_cost)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total Amount:</strong></td>
                            <td><strong><?php echo e(formatAmount($pujaOrder->total_amount)); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php if($pujaOrder->paymentTransactions->isNotEmpty()): ?>
    <div class="card callout callout-success puja-card">
        <div class="card-header ">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="card-title" style="font-size:24px">
                        Transaction Details
                    </h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $pujaOrder->paymentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <p class="col-md-4">Transaction ID:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->id); ?></p>

                    <p class="col-md-4">PayPal Order ID:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_order_id ?? 'N/A'); ?></p>

                    <p class="col-md-4">PayPal Capture ID:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_capture_id ?? 'N/A'); ?></p>

                    <p class="col-md-4">Status:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_status ?? 'N/A'); ?></p>

                    <p class="col-md-4">Paid:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_paid ? 'Yes' : 'No'); ?></p>

                    <p class="col-md-4">Amount:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e(formatAmount($transaction->paypal_amount)); ?></p>

                    <p class="col-md-4">Currency:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_currency ?? 'N/A'); ?></p>

                    <p class="col-md-4">Payer Email:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_payer_email ?? 'N/A'); ?></p>

                    <p class="col-md-4">Payer ID:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_payer_id ?? 'N/A'); ?></p>

                    <p class="col-md-4">Created At:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_create_time ?? $transaction->created_at); ?></p>

                    <p class="col-md-4">Updated At:</p>
                    <p class="col-md-8 font-weight-bold"><?php echo e($transaction->paypal_update_time ?? $transaction->updated_at); ?></p>
                </div>

                <?php if(!$loop->last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/puja_orders/show_fields.blade.php ENDPATH**/ ?>