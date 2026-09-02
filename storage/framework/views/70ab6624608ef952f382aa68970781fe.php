<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halls</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-halls')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('halls.create')); ?>">
                            Add New
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card">
            <div class="card-body">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('halls-table', [])->html();
} elseif ($_instance->childHasBeenRendered('WTMTZeN')) {
    $componentId = $_instance->getRenderedChildComponentId('WTMTZeN');
    $componentTag = $_instance->getRenderedChildComponentTagName('WTMTZeN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('WTMTZeN');
} else {
    $response = \Livewire\Livewire::mount('halls-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('WTMTZeN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\halls\index.blade.php ENDPATH**/ ?>