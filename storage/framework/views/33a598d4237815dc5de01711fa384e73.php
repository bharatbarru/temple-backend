<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Old Hall Booking Requests</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                
                <div class="form-search-inline column-settings-inline pb-3">
                    <form class="form-inline form-search" method="GET" action="<?php echo e(route('old.hall.requests')); ?>" autocomplete="off">
                        <div class="row text-left" style="flex-wrap: nowrap;">
                            <div class="col">
                                <label class="sr-only" for="inputSearch">Search</label>
                                <input type="text" class="form-control" id="inputSearch" name="search"
                                    placeholder="Request Id, Name of Requestor" value="<?php echo e(request()->get('search')); ?>" style="width: 300px;">
                            </div>
                            <div class="col">
                                <select class="form-control select2" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="PENDING" <?php echo e(request()->get('status') == "PENDING" ? 'selected' : ''); ?>>NEW_REQUEST</option>
                                    <option value="RESCHEDULE_REQUEST" <?php echo e(request()->get('status') == "RESCHEDULE_REQUEST" ? 'selected' : ''); ?>>RESCHEDULE_REQUEST</option>
                                    <option value="CANCEL_REQUEST" <?php echo e(request()->get('status') == "CANCEL_REQUEST" ? 'selected' : ''); ?>>CANCEL_REQUEST</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inputFromDate">From Date</label>
                                <input type="date" name="from_date" class="form-control datepicker date-icon"
                                    id="inputFromDate" placeholder="From Date" value="<?php echo e(request()->get('from_date')); ?>">
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inputToDate">To Date</label>
                                <input type="date" name="to_date" class="form-control datepicker date-icon"
                                    id="inputToDate" placeholder="To Date" value="<?php echo e(request()->get('to_date')); ?>">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
                                <a href="<?php echo e(route('old.hall.requests')); ?>" class="btn btn-info mb-2">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>

                <div class="status-container">
                    <?php
                        $statuses = [
                            ['name' => NEW_REQUEST, 'class' => getClassNameFromStatus(NEW_REQUEST)],
                            ['name' => RESCHEDULE_REQUEST, 'class' => getClassNameFromStatus(RESCHEDULE_REQUEST)],
                            ['name' => CANCEL_REQUEST, 'class' => getClassNameFromStatus(CANCEL_REQUEST)],
                        ];
                    ?>
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="status-item">
                            <span class="color-box <?php echo e($status['class']); ?>"></span>
                            <?php echo e($status['name']); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <h6><?php echo e($orders->total()); ?> Records Found</h6>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Request Id</th>
                                <th>Package / Addons</th>
                                <th>Payment Status</th>
                                <th>Date of Request	</th>
                                <th>Date / Time of Event</th>
                                <th>Individual / Community Name</th>
                                <th>Email / Phone</th>
                                <th>Request Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e(getClassNameFromStatus($order->request_status)); ?>">
                                <td><a href="<?php echo e(route('old_hallrequest.show', $order->order_id)); ?>"><?php echo e($order->hall_request_id); ?></a></td>
                                <td>
                                    <span style="color: #cc0000">Package:- </span>
                                    <?php echo e($order->package_type_name); ?> -
                                    <b><?php echo e($order->package_name); ?></b>
                                </td>
                                <td><?php echo e($order->payment_status); ?></td>
                                <td><?php echo e(formatDate($order->order_date)); ?></td>
                                <td>
                                    <?php echo e(formatDate($order->date_of_event)); ?><br>
                                    <?php echo e(formatTime($order->start_time)); ?>

                                </td>
                                <td><?php echo e($order->first_name . ' ' . $order->last_name); ?></td>
                                <td>
                                    <?php echo e($order->email); ?><br>
                                    <?php echo e($order->primary_phone); ?>

                                </td>
                                <td><?php echo e($order->request_status == 'PENDING' ? NEW_REQUEST : $order->request_status); ?></td>
                                <td>
                                    <a href="<?php echo e(route('old_hallrequest.show', $order->order_id)); ?>" class="btn btn-default btn-xs" contenteditable="false" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9">No puja requests found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($orders->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#inputFromDate').datepicker()
        $('#inputToDate').datepicker()
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\old_hallrequests\index.blade.php ENDPATH**/ ?>