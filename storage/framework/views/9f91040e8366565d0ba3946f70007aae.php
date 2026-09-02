<?php
    $theme = $component->getTheme();
    $filterLayout = $component->getFilterLayout();
    $tableName = $component->getTableName();
?>
<div>
    <?php if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition()): ?>
        <?php echo $__env->make($filter->getCustomFilterLabel(),['filter' => $filter, 'theme' => $theme, 'filterLayout' => $filterLayout, 'tableName' => $tableName  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php elseif(!$filter->hasCustomPosition()): ?>
        <?php if (isset($component)) { $__componentOriginal3d520986b3faee512e1fc7aea1837396 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d520986b3faee512e1fc7aea1837396 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-tables::components.tools.filter-label','data' => ['filter' => $filter,'theme' => $theme,'filterLayout' => $filterLayout,'tableName' => $tableName]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-tables::tools.filter-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['filter' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filter),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'filterLayout' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterLayout),'tableName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableName)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d520986b3faee512e1fc7aea1837396)): ?>
<?php $attributes = $__attributesOriginal3d520986b3faee512e1fc7aea1837396; ?>
<?php unset($__attributesOriginal3d520986b3faee512e1fc7aea1837396); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d520986b3faee512e1fc7aea1837396)): ?>
<?php $component = $__componentOriginal3d520986b3faee512e1fc7aea1837396; ?>
<?php unset($__componentOriginal3d520986b3faee512e1fc7aea1837396); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php if($theme === 'tailwind'): ?>
        <div class="rounded-md shadow-sm">
            <input
                wire:model.stop="<?php echo e($tableName); ?>.filters.<?php echo e($filter->getKey()); ?>"
                wire:key="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>"
                id="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>"
                type="date"
                <?php if($filter->hasConfig('min')): ?> min="<?php echo e($filter->getConfig('min')); ?>" <?php endif; ?>
                <?php if($filter->hasConfig('max')): ?> max="<?php echo e($filter->getConfig('max')); ?>" <?php endif; ?>
                class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
            />
        </div>
    <?php elseif($theme === 'bootstrap-4' || $theme === 'bootstrap-5'): ?>
        <div class="mb-3 mb-md-0 input-group">
            <input
                wire:model.stop="<?php echo e($tableName); ?>.filters.<?php echo e($filter->getKey()); ?>"
                wire:key="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>"
                id="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>"
                type="date"
                <?php if($filter->hasConfig('min')): ?> min="<?php echo e($filter->getConfig('min')); ?>" <?php endif; ?>
                <?php if($filter->hasConfig('max')): ?> max="<?php echo e($filter->getConfig('max')); ?>" <?php endif; ?>
                class="form-control"
            />
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\rappasoft\laravel-livewire-tables\resources\views\components\tools\filters\date.blade.php ENDPATH**/ ?>