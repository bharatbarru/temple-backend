<?php $__env->startSection('content'); ?>
    <?php
        $heading = request()->get('type') ? request()->get('type') : request()->get('main');
    ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit <?php echo e(ucwords(str_replace('-', ' ', $heading))); ?>

                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <?php echo $__env->make('adminlte-templates::common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card">

            <?php echo Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'patch', 'files' => true]); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo $__env->make('services.fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>

            <div class="card-footer">
                <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

                <a href="<?php echo e(route('services.index') . '?type=' . request()->get('type')); ?>" class="btn btn-default"> Cancel </a>
            </div>

            <?php echo Form::close(); ?>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\services\edit.blade.php ENDPATH**/ ?>