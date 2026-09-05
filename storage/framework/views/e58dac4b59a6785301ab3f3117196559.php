<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Puja Orders</h1>
                </div>
                <div class="col-sm-6">
                    
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
    $html = \Livewire\Livewire::mount('puja-orders-table', [])->html();
} elseif ($_instance->childHasBeenRendered('bVnQdR6')) {
    $componentId = $_instance->getRenderedChildComponentId('bVnQdR6');
    $componentTag = $_instance->getRenderedChildComponentTagName('bVnQdR6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bVnQdR6');
} else {
    $response = \Livewire\Livewire::mount('puja-orders-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('bVnQdR6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/puja_orders/index.blade.php ENDPATH**/ ?>