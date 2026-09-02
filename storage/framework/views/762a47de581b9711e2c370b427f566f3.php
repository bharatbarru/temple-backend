<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Categories</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('serviceCategories.create')); ?>">
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
    $html = \Livewire\Livewire::mount('service-categories-table', [])->html();
} elseif ($_instance->childHasBeenRendered('HfU4cbL')) {
    $componentId = $_instance->getRenderedChildComponentId('HfU4cbL');
    $componentTag = $_instance->getRenderedChildComponentTagName('HfU4cbL');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('HfU4cbL');
} else {
    $response = \Livewire\Livewire::mount('service-categories-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('HfU4cbL', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\service_categories\index.blade.php ENDPATH**/ ?>