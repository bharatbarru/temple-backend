<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Photo Galleries</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('photoGalleries.create')); ?>">
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
    $html = \Livewire\Livewire::mount('photo-galleries-table', [])->html();
} elseif ($_instance->childHasBeenRendered('cIHPqXE')) {
    $componentId = $_instance->getRenderedChildComponentId('cIHPqXE');
    $componentTag = $_instance->getRenderedChildComponentTagName('cIHPqXE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('cIHPqXE');
} else {
    $response = \Livewire\Livewire::mount('photo-galleries-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('cIHPqXE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\photo_galleries\index.blade.php ENDPATH**/ ?>