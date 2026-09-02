<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Team Categories</h1>
                </div>
                <div class="col-sm-6">                    
                    <?php if(auth()->user()->hasPermissionTo('add-team_categories')): ?>
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('teamCategories.create')); ?>">
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
    $html = \Livewire\Livewire::mount('team-categories-table', [])->html();
} elseif ($_instance->childHasBeenRendered('5EqTCVh')) {
    $componentId = $_instance->getRenderedChildComponentId('5EqTCVh');
    $componentTag = $_instance->getRenderedChildComponentTagName('5EqTCVh');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5EqTCVh');
} else {
    $response = \Livewire\Livewire::mount('team-categories-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('5EqTCVh', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\team_categories\index.blade.php ENDPATH**/ ?>