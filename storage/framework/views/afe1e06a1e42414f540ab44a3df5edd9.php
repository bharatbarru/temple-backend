<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hall Event Types</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-hall-event-types')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('hallEventTypes.create')); ?>">
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
    $html = \Livewire\Livewire::mount('hall-event-types-table', [])->html();
} elseif ($_instance->childHasBeenRendered('m1buu4V')) {
    $componentId = $_instance->getRenderedChildComponentId('m1buu4V');
    $componentTag = $_instance->getRenderedChildComponentTagName('m1buu4V');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('m1buu4V');
} else {
    $response = \Livewire\Livewire::mount('hall-event-types-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('m1buu4V', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\hall_event_types\index.blade.php ENDPATH**/ ?>