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
} elseif ($_instance->childHasBeenRendered('dB6lVui')) {
    $componentId = $_instance->getRenderedChildComponentId('dB6lVui');
    $componentTag = $_instance->getRenderedChildComponentTagName('dB6lVui');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('dB6lVui');
} else {
    $response = \Livewire\Livewire::mount('puja-orders-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('dB6lVui', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\puja_orders\index.blade.php ENDPATH**/ ?>