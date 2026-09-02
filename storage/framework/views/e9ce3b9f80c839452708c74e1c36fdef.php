<div class="card callout-success-bg puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Temple Tour Info
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
            <h5 class="col-md-4 text-primary">Tour Request ID:</h5>
            <h5 class="col-md-8 text-primary" style="font-weight:bold"><?php echo e($templeTour->tour_request_id); ?></h5>
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
                    <?php $__currentLoopData = $templeTour->orderStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <p class="col-md-4">Name of group/individual:</p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($templeTour->name); ?></p>

            <p class="col-md-4">Email </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($templeTour->email); ?></p>

            <p class="col-md-4">Mobile: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($templeTour->mobile); ?></p>
        </div>
    </div>
</div>

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Requested Tour Info
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">Total Visitors:</p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($templeTour->total_visitors); ?></p>

            <p class="col-md-4">Age Range Of Group: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($templeTour->age_range_of_group); ?></p>

            <p class="col-md-4">Tour Date / Time:</p>
            <p class="col-md-8 " style="font-weight:bold">
                <?php echo e(formatDate($templeTour->tour_date) . ', ' . formatTime($templeTour->tour_time)); ?></p>

            <p class="col-md-4">Alternate Tour Date / Time:</p>
            <p class="col-md-8 " style="font-weight:bold">
                <?php echo e(formatDate($templeTour->alternate_tour_date) . ' , ' . formatTime($templeTour->alternate_tour_time)); ?></p>

            <p class="col-md-4">Last Visit To Temple: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($templeTour->last_visit_to_temple ? 'Yes' : 'No'); ?></p>

            <p class="col-md-4">Comment:</p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e($templeTour->comment); ?></p>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\temple_tours\show_fields.blade.php ENDPATH**/ ?>