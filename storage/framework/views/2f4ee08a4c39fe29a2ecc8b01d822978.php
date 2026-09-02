<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Frontend Users</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-frontend-users')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('frontendUsers.create')); ?>">
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
    $html = \Livewire\Livewire::mount('frontend-users-table', [])->html();
} elseif ($_instance->childHasBeenRendered('PqY559v')) {
    $componentId = $_instance->getRenderedChildComponentId('PqY559v');
    $componentTag = $_instance->getRenderedChildComponentTagName('PqY559v');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('PqY559v');
} else {
    $response = \Livewire\Livewire::mount('frontend-users-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('PqY559v', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\frontend_users\index.blade.php ENDPATH**/ ?>