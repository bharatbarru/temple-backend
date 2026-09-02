<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog Categories</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-blog_categories')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('blogCategories.create')); ?>">
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
    $html = \Livewire\Livewire::mount('blog-categories-table', [])->html();
} elseif ($_instance->childHasBeenRendered('2DtSjxn')) {
    $componentId = $_instance->getRenderedChildComponentId('2DtSjxn');
    $componentTag = $_instance->getRenderedChildComponentTagName('2DtSjxn');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('2DtSjxn');
} else {
    $response = \Livewire\Livewire::mount('blog-categories-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('2DtSjxn', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\blog_categories\index.blade.php ENDPATH**/ ?>