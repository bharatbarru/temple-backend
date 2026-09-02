<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Teams</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-teams')): ?>
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('teams.create')); ?>">
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
    $html = \Livewire\Livewire::mount('teams-table', [])->html();
} elseif ($_instance->childHasBeenRendered('D0huTkL')) {
    $componentId = $_instance->getRenderedChildComponentId('D0huTkL');
    $componentTag = $_instance->getRenderedChildComponentTagName('D0huTkL');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('D0huTkL');
} else {
    $response = \Livewire\Livewire::mount('teams-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('D0huTkL', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\teams\index.blade.php ENDPATH**/ ?>