<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Temple Tours</h1>
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
    $html = \Livewire\Livewire::mount('temple-tours-table', [])->html();
} elseif ($_instance->childHasBeenRendered('fFUPcnq')) {
    $componentId = $_instance->getRenderedChildComponentId('fFUPcnq');
    $componentTag = $_instance->getRenderedChildComponentTagName('fFUPcnq');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fFUPcnq');
} else {
    $response = \Livewire\Livewire::mount('temple-tours-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('fFUPcnq', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\temple_tours\index.blade.php ENDPATH**/ ?>