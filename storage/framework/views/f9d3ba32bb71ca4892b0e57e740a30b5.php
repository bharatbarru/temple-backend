<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-success float-right" href="<?php echo e(route('reports.export', request()->query())); ?>">
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                
                <div class="form-search-inline column-settings-inline pb-3">
                    <form method="GET" action="<?php echo e(route('reports.index')); ?>" autocomplete="off">
                        <div class="row text-left">
                            <div class="col-md-3 mb-2">
                                <label for="inputType">Report</label>
                                <select class="form-control" id="inputType" name="type">
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>" <?php echo e($report->type() == $value ? 'selected' : ''); ?>>
                                            <?php echo e($label); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label for="inputFrom">From Date</label>
                                <input type="date" name="from" class="form-control" id="inputFrom"
                                    value="<?php echo e($report->filter('from')); ?>">
                            </div>

                            <div class="col-md-2 mb-2">
                                <label for="inputTo">To Date</label>
                                <input type="date" name="to" class="form-control" id="inputTo"
                                    value="<?php echo e($report->filter('to')); ?>">
                            </div>

                            <?php if($report->supportsSource()): ?>
                                <div class="col-md-2 mb-2">
                                    <label for="inputSource">Booked From</label>
                                    <select class="form-control" id="inputSource" name="source">
                                        <option value="">All Sources</option>
                                        <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>"
                                                <?php echo e($report->filter('source') == $value ? 'selected' : ''); ?>>
                                                <?php echo e($label); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <?php if($report->supportsPaymentStatus()): ?>
                                <div class="col-md-2 mb-2">
                                    <label for="inputPaymentStatus">Payment Status</label>
                                    <select class="form-control" id="inputPaymentStatus" name="payment_status">
                                        <option value="">All Statuses</option>
                                        <?php $__currentLoopData = $paymentStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($status); ?>"
                                                <?php echo e($report->filter('payment_status') == $status ? 'selected' : ''); ?>>
                                                <?php echo e($status); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-3 mb-2">
                                <label for="inputSearch">Search</label>
                                <input type="text" class="form-control" id="inputSearch" name="search"
                                    placeholder="Request Id, Name, Email, Mobile"
                                    value="<?php echo e($report->filter('search')); ?>">
                            </div>

                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary mb-2 mr-2">Apply Filters</button>
                                <a href="<?php echo e(route('reports.index', ['type' => $report->type()])); ?>"
                                    class="btn btn-info mb-2 mr-2">Reset</a>
                                <a href="<?php echo e(route('reports.export', request()->query())); ?>"
                                    class="btn btn-success mb-2">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>

                <?php if($report->notice()): ?>
                    <div class="alert alert-info"><?php echo e($report->notice()); ?></div>
                <?php endif; ?>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Records</span>
                                <span class="info-box-number"><?php echo e(number_format($summary['count'])); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if($summary['amount_label']): ?>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-money-bill-wave"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo e($summary['amount_label']); ?></span>
                                    <span class="info-box-number">
                                        <?php echo e(currencySymbol()); ?><?php echo e(number_format($summary['amount'], 2)); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <h6><?php echo e($report->label()); ?> &mdash; <?php echo e(number_format($records->total())); ?> Records Found</h6>

                <?php
                    $headings = $report->headings();
                    $amountColumns = $report->amountColumns();
                ?>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <?php $__currentLoopData = $headings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $heading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th style="white-space: nowrap;"><?php echo e($heading); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($records->firstItem() + $index); ?></td>
                                    <?php $__currentLoopData = $report->map($record); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php if(in_array($column, $amountColumns) && $value !== null && $value !== ''): ?>
                                                <?php echo e(currencySymbol()); ?><?php echo e(number_format($value, 2)); ?>

                                            <?php else: ?>
                                                <?php echo e($value); ?>

                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="<?php echo e(count($headings) + 1); ?>">
                                        No records found for the selected filters.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php echo e($records->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views/reports/index.blade.php ENDPATH**/ ?>