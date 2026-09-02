<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupons</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-coupons')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('coupons.create')); ?>">
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
    $html = \Livewire\Livewire::mount('coupons-table', [])->html();
} elseif ($_instance->childHasBeenRendered('fOt8V1b')) {
    $componentId = $_instance->getRenderedChildComponentId('fOt8V1b');
    $componentTag = $_instance->getRenderedChildComponentTagName('fOt8V1b');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fOt8V1b');
} else {
    $response = \Livewire\Livewire::mount('coupons-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('fOt8V1b', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\coupons\index.blade.php ENDPATH**/ ?>