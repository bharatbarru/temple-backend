<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application Setting Categories</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-application-setting-categories')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('applicationSettingCategories.create')); ?>">
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
    $html = \Livewire\Livewire::mount('application-setting-categories-table', [])->html();
} elseif ($_instance->childHasBeenRendered('Hc4dVxk')) {
    $componentId = $_instance->getRenderedChildComponentId('Hc4dVxk');
    $componentTag = $_instance->getRenderedChildComponentTagName('Hc4dVxk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Hc4dVxk');
} else {
    $response = \Livewire\Livewire::mount('application-setting-categories-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('Hc4dVxk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_setting_categories\index.blade.php ENDPATH**/ ?>