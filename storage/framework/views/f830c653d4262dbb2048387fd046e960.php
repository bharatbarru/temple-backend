<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-permissions')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('permissions.create')); ?>">
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
    $html = \Livewire\Livewire::mount('permissions-table', [])->html();
} elseif ($_instance->childHasBeenRendered('aVhoB8t')) {
    $componentId = $_instance->getRenderedChildComponentId('aVhoB8t');
    $componentTag = $_instance->getRenderedChildComponentTagName('aVhoB8t');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('aVhoB8t');
} else {
    $response = \Livewire\Livewire::mount('permissions-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('aVhoB8t', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\user-management\permissions\index.blade.php ENDPATH**/ ?>