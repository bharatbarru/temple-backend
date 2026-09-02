<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application Setting Types</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-application-setting-types')): ?>
                        <a class="btn btn-primary float-right"
                        href="<?php echo e(route('applicationSettingTypes.create')); ?>">
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
    $html = \Livewire\Livewire::mount('application-setting-types-table', [])->html();
} elseif ($_instance->childHasBeenRendered('92rtTLb')) {
    $componentId = $_instance->getRenderedChildComponentId('92rtTLb');
    $componentTag = $_instance->getRenderedChildComponentTagName('92rtTLb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('92rtTLb');
} else {
    $response = \Livewire\Livewire::mount('application-setting-types-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('92rtTLb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\application_setting_types\index.blade.php ENDPATH**/ ?>