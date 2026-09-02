<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
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
    $html = \Livewire\Livewire::mount('orders-table', [])->html();
} elseif ($_instance->childHasBeenRendered('WiP0vNe')) {
    $componentId = $_instance->getRenderedChildComponentId('WiP0vNe');
    $componentTag = $_instance->getRenderedChildComponentTagName('WiP0vNe');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('WiP0vNe');
} else {
    $response = \Livewire\Livewire::mount('orders-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('WiP0vNe', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\orders\index.blade.php ENDPATH**/ ?>