<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Methods</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-payment-methods')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('paymentMethods.create')); ?>">
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
    $html = \Livewire\Livewire::mount('payment-methods-table', [])->html();
} elseif ($_instance->childHasBeenRendered('X3BJFOh')) {
    $componentId = $_instance->getRenderedChildComponentId('X3BJFOh');
    $componentTag = $_instance->getRenderedChildComponentTagName('X3BJFOh');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('X3BJFOh');
} else {
    $response = \Livewire\Livewire::mount('payment-methods-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('X3BJFOh', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\payment_methods\index.blade.php ENDPATH**/ ?>