<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Faqs</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-faqs')): ?>
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('faqs.create')); ?>">
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
    $html = \Livewire\Livewire::mount('faqs-table', [])->html();
} elseif ($_instance->childHasBeenRendered('d7WXiOF')) {
    $componentId = $_instance->getRenderedChildComponentId('d7WXiOF');
    $componentTag = $_instance->getRenderedChildComponentTagName('d7WXiOF');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('d7WXiOF');
} else {
    $response = \Livewire\Livewire::mount('faqs-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('d7WXiOF', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\faqs\index.blade.php ENDPATH**/ ?>