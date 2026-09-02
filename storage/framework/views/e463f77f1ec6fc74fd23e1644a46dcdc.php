<?php $__env->startSection('content'); ?>
    <?php
        $heading = request()->get('type') ? request()->get('type') : request()->get('main');
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e(ucwords(str_replace('-', ' ', $heading))); ?></h1>
                </div>
                <div class="col-sm-6">
                    <?php if(request()->get('type')): ?>
                        <a class="btn btn-primary float-right"
                           href="<?php echo e(route('services.create') . '?type=' . request()->get('type')); ?>">
                            Add New
                        </a>
                    <?php endif; ?>

                    <?php if(request()->get('main')): ?>
                        <a class="btn btn-primary float-right"
                           href="<?php echo e(route('services.create') . '?main=' . request()->get('main')); ?>">
                            Add New
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('services-table', ['type' => request()->get('type'), 'main' => request()->get('main')])->html();
} elseif ($_instance->childHasBeenRendered('WoTDHvX')) {
    $componentId = $_instance->getRenderedChildComponentId('WoTDHvX');
    $componentTag = $_instance->getRenderedChildComponentTagName('WoTDHvX');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('WoTDHvX');
} else {
    $response = \Livewire\Livewire::mount('services-table', ['type' => request()->get('type'), 'main' => request()->get('main')]);
    $html = $response->html();
    $_instance->logRenderedChild('WoTDHvX', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\services\index.blade.php ENDPATH**/ ?>