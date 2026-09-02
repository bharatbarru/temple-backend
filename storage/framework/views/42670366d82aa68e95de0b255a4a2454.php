<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Statistics</h1>
                </div>
                
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-statistics')): ?>
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('statistics.create')); ?>">
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
    $html = \Livewire\Livewire::mount('statistics-table', [])->html();
} elseif ($_instance->childHasBeenRendered('IXOR0F6')) {
    $componentId = $_instance->getRenderedChildComponentId('IXOR0F6');
    $componentTag = $_instance->getRenderedChildComponentTagName('IXOR0F6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('IXOR0F6');
} else {
    $response = \Livewire\Livewire::mount('statistics-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('IXOR0F6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\statistics\index.blade.php ENDPATH**/ ?>