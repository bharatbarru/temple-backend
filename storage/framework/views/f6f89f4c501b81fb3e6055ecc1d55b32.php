<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pujas</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('pujas.create')); ?>">
                        Add New
                    </a>
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
    $html = \Livewire\Livewire::mount('pujas-table', [])->html();
} elseif ($_instance->childHasBeenRendered('a3iFBcb')) {
    $componentId = $_instance->getRenderedChildComponentId('a3iFBcb');
    $componentTag = $_instance->getRenderedChildComponentTagName('a3iFBcb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('a3iFBcb');
} else {
    $response = \Livewire\Livewire::mount('pujas-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('a3iFBcb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/pujas/index.blade.php ENDPATH**/ ?>