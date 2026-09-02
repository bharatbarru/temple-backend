<?php foreach ((['component']) as $__key => $__value) {
    $__consumeVariable = is_string($__key) ? $__key : $__value;
    $$__consumeVariable = is_string($__key) ? $__env->getConsumableComponentData($__key, $__value) : $__env->getConsumableComponentData($__value);
} ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['filter', 'theme' => 'tailwind', 'filterLayout' => 'popover', 'tableName' => 'table']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['filter', 'theme' => 'tailwind', 'filterLayout' => 'popover', 'tableName' => 'table']); ?>
<?php foreach (array_filter((['filter', 'theme' => 'tailwind', 'filterLayout' => 'popover', 'tableName' => 'table']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<label for="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?>" 
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'block text-sm font-medium leading-5 text-gray-700 dark:text-white' => $theme === 'tailwind',
        'd-block' => $theme === 'bootstrap-4' && $filterLayout == 'slide-down',
        'mb-2' => $theme === 'bootstrap-4' && $filterLayout == 'popover',
        'd-block' => $theme === 'bootstrap-5' && $filterLayout == 'slide-down',
        'mb-2' => $theme === 'bootstrap-5' && $filterLayout == 'popover',
    ]); ?>"
>
    <?php echo e($filter->getName()); ?>

</label>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\rappasoft\laravel-livewire-tables\resources\views\components\tools\filter-label.blade.php ENDPATH**/ ?>