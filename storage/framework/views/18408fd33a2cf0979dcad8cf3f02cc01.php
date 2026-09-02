<div class="card callout-success-bg puja-card">
    <div class="card-header ">
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
            <h5 class="col-md-8 text-primary" style="font-weight:bold"><?php echo e($hallOrder->hall_request_id); ?></h5>
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
                    <?php $__currentLoopData = $hallOrder->orderStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($hallOrder->user->first_name . ' ' . $hallOrder->user->last_name); ?></p>

            <p class="col-md-4">Address: </p>
            <p class="col-md-8 font-weight-bold">
                <?php echo e(implode(', ', array_filter([
                    $hallOrder->user->address,
                    $hallOrder->user->city,
                    $hallOrder->user->state,
                    $hallOrder->user->pincode,
                    $hallOrder->user->country
                ], fn($value) => !is_null($value) && $value !== ''))); ?>

            </p>

            <p class="col-md-4">Contact No</p>
            <p class="col-md-8 font-weight-bold"><?php echo e($hallOrder->user->mobile); ?></p>

            <p class="col-md-4">Email</p>
            <p class="col-md-8 font-weight-bold"><?php echo e($hallOrder->user->email); ?></p>


        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php
    $statuses = $hallOrder->orderStatuses->pluck('status')->toArray();
?>

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Requested Hall Booking Info
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">Type Of Event: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($hallOrder->type_of_event); ?></p>

            <?php if($hallOrder->type_of_event == 'community'): ?>
                <p class="col-md-4">Event Duration: </p>
                <p class="col-md-8 " style="font-weight:bold">
                    <?php if($hallOrder->event_duration == 'multiple-days'): ?>
                        <?php echo e($hallOrder->number_of_days); ?> Day Event
                    <?php else: ?>
                        1 Day Event
                    <?php endif; ?>
                </p>
            <?php endif; ?>

            <p class="col-md-4">Hall Event Type: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($hallOrder->hallEventType->name ?? ''); ?></p>

            <?php if($hallOrder->hallEventType && $hallOrder->hallEventType->name == 'Other'): ?>
                <p class="col-md-4">Other Event Type: </p>
                <p class="col-md-8 " style="font-weight:bold"><?php echo e($hallOrder->other_event_type); ?></p>
            <?php endif; ?>

            <p class="col-md-4">Date of Event: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e(formatDate($hallOrder->date_of_event)); ?></p>

            <?php if($hallOrder->event_duration == 'multiple-days'): ?>
                <p class="col-md-4">End Date of Event: </p>
                <p class="col-md-8 " style="font-weight:bold">
                    <?php if($hallOrder->event_duration == 'multiple-days'): ?>
                        <?php echo e(formatDate(\Carbon\Carbon::parse($hallOrder->date_of_event)->addDays($hallOrder->number_of_days - 1 ))); ?>

                    <?php endif; ?>
                </p>
            <?php endif; ?>

            <p class="col-md-4">
                Start Time:
                <?php if(in_array(RESCHEDULE_REQUEST, $statuses)): ?>
                    <span class="badge badge-primary">Rescheduled</span>
                <?php endif; ?>
            </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e(formatTime($hallOrder->start_time)); ?></p>

            <p class="col-md-4">Duration: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($hallOrder->duration); ?> hours</p>

            <p class="col-md-4">Alternate Date Of Event: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e(formatDate($hallOrder->alternate_date_of_event)); ?></p>

            <p class="col-md-4">Comments: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($hallOrder->comments); ?></p>
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
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($hallOrder->changed_by); ?></p>

                <p class="col-md-4">Changed Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($hallOrder->changed_comments); ?></p>
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
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($hallOrder->cancelled_by); ?></p>

                <p class="col-md-4">Cancelled Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> <?php echo e($hallOrder->cancelled_comments); ?></p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
<?php endif; ?>

<div class="card callout callout-danger puja-card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Halls / Addons
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
                        <?php $__currentLoopData = $hallOrder->hallOrderLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hallOrderList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($hallOrderList->hall->name ?? 'N/A'); ?> <?php if($hallOrderList->no_of_hours): ?> (For <?php echo e($hallOrderList->no_of_hours); ?> hours)<?php endif; ?></td>
                                <td>$<?php echo e($hallOrder->type_of_event == 'hindu_temple' ? '0.00' : number_format($hallOrderList->hall_cost, 2)); ?></td>
                            </tr>
                            <?php
                                $hallAddonLists = $hallOrder->hallOrderAddonsLists->where('hall_id', $hallOrderList->hall_id);
                            ?>
                            <?php $__currentLoopData = $hallAddonLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hallAddonList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>&nbsp;&nbsp;<i class="nav-icon fas fa-check"></i> <?php echo e($hallAddonList->hallAddon->name); ?> <?php if($hallAddonList->no_of_hours): ?> (For <?php echo e($hallAddonList->no_of_hours); ?> hours)<?php endif; ?></td>
                                    <td>$<?php echo e($hallOrder->type_of_event == 'hindu_temple' ? '0.00' : number_format($hallAddonList->addon_cost, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total Amount:</strong></td>
                            <td><strong>$<?php echo e($hallOrder->type_of_event == 'hindu_temple' ? '0.00' : number_format($hallOrder->total_amount, 2)); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\hall_orders\show_fields.blade.php ENDPATH**/ ?>