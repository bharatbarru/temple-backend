<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hall Orders</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-hall-orders')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('hallOrders.create')); ?>">
                            Add New
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="clearfix"></div>

        <?php echo $__env->make('common.status-legend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card">
            <div class="card-body">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('hall-orders-table', [])->html();
} elseif ($_instance->childHasBeenRendered('hIOduhk')) {
    $componentId = $_instance->getRenderedChildComponentId('hIOduhk');
    $componentTag = $_instance->getRenderedChildComponentTagName('hIOduhk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hIOduhk');
} else {
    $response = \Livewire\Livewire::mount('hall-orders-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('hIOduhk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\hall_orders\index.blade.php ENDPATH**/ ?>