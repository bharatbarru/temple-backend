<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Log</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                
                <div class="form-search-inline  column-settings-inline">
                    <form class="form-inline form-search" method="GET" action="" autocomplete="off">
                        <div class="row text-left" style="flex-wrap: nowrap;">
                            <div class="col">
                                <label class="sr-only" for="inputSearch">Search</label>
                                <input type="text" class="form-control" id="inputSearch" name="search"
                                    placeholder="Description, Details" value="<?php echo e(request()->get('search')); ?>">
                            </div>
                            <div class="col">
                                <select class="form-control select2" id="user" name="user">
                                    <option value="">Select Action By</option>
                                    <?php $__currentLoopData = getUsers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"
                                            <?php echo e(request()->get('user') == $user->id ? 'selected' : ''); ?>>
                                            <?php echo e($user->user_name . ' - ' . $user->role_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <a href="<?php echo url('admin/activity-log'); ?>" class="btn btn-info mb-2">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
                
                <div class="log-content table-responsive">
                    <table class="table table-bordered table-striped table-hover  custom-table-styles" aria-describedby="table">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Description</th>
                                <th>Details</th>
                                <th>Action By</th>
                                <th>Action Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php ($i = 1); ?>
                            <?php $__currentLoopData = $activityLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($log->description); ?></td>
                                    <td class="details-section">
                                        <?php ($dataArray = $log->properties != '' ? json_decode($log->properties, true) : ''); ?>
                                        <?php if($dataArray != ''): ?>
                                            
                                            <ul>
                                                <?php $__currentLoopData = $dataArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($key); ?>: <?php echo str_replace('\\/', '/', json_encode($value)); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(getUserName($log->subject_id)); ?></td>
                                    <td><?php echo e(formatDateTime($log->created_at)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-left">
                        <p class="record_count"><?php echo e($activityLogs->total()); ?> Records Found</p>
                    </div>
                    <div class="float-right">
                        <?php echo $__env->make('adminlte-templates::common.paginate', [
                            'records' => $activityLogs->appends(request()->query()),
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\log.blade.php ENDPATH**/ ?>