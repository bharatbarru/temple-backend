<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e(ucwords(str_replace('-', ' ', request()->get('type')))); ?></h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-clienteles')): ?>
                        <a class="btn btn-primary float-right" href="<?php echo e(route('clienteles.create') . '?type=' . request()->get('type')); ?>">
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
    $html = \Livewire\Livewire::mount('clienteles-table', ['type' => request()->get('type')])->html();
} elseif ($_instance->childHasBeenRendered('OvjeDw5')) {
    $componentId = $_instance->getRenderedChildComponentId('OvjeDw5');
    $componentTag = $_instance->getRenderedChildComponentTagName('OvjeDw5');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('OvjeDw5');
} else {
    $response = \Livewire\Livewire::mount('clienteles-table', ['type' => request()->get('type')]);
    $html = $response->html();
    $_instance->logRenderedChild('OvjeDw5', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\clienteles\index.blade.php ENDPATH**/ ?>