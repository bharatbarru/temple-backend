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
        <div class="rounded-md">
            <div>
                <input
                    type="checkbox"
                    id="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-select-all"
                    wire:input="selectAllFilterOptions('<?php echo e($filter->getKey()); ?>')"
                    <?php echo e(count($component->getAppliedFilterWithValue($filter->getKey()) ?? []) === count($filter->getOptions()) ? 'checked' : ''); ?>


                    class="text-indigo-600 rounded border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                >
                <label for="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-select-all" class="dark:text-white"><?php echo app('translator')->get('All'); ?></label>
            </div>

            <?php $__currentLoopData = $filter->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div wire:key="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-multiselect-<?php echo e($key); ?>">
                    <input
                        type="checkbox"
                        id="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-<?php echo e($loop->index); ?>"
                        value="<?php echo e($key); ?>"
                        wire:key="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-<?php echo e($loop->index); ?>"
                        wire:model.stop="<?php echo e($tableName); ?>.filters.<?php echo e($filter->getKey()); ?>"
                        <?php echo e(count($component->getAppliedFilterWithValue($filter->getKey()) ?? []) === count($filter->getOptions()) ? 'disabled' : ''); ?>

                        :class="{'disabled:bg-gray-400 disabled:hover:bg-gray-400' : <?php echo e(count($component->getAppliedFilterWithValue($filter->getKey()) ?? []) === count($filter->getOptions()) ? 'true' : 'false'); ?>}"
                        class="text-indigo-600 rounded border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                    >
                    <label for="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-<?php echo e($loop->index); ?>" class="dark:text-white"><?php echo e($value); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php elseif($theme === 'bootstrap-4' || $theme === 'bootstrap-5'): ?>
        <div class="form-check">
            <input
                type="checkbox"
                id="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-select-all"
                wire:input="selectAllFilterOptions('<?php echo e($filter->getKey()); ?>')"
                <?php echo e(count($component->getAppliedFilterWithValue($filter->getKey()) ?? []) === count($filter->getOptions()) ? 'checked' : ''); ?>

                class="form-check-input"
            >
            <label class="form-check-label" for="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-select-all"><?php echo app('translator')->get('All'); ?></label>
        </div>

        <?php $__currentLoopData = $filter->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check" wire:key="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-multiselect-<?php echo e($key); ?>">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-<?php echo e($loop->index); ?>"
                    value="<?php echo e($key); ?>"
                    wire:key="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-<?php echo e($loop->index); ?>"
                    wire:model.stop="<?php echo e($tableName); ?>.filters.<?php echo e($filter->getKey()); ?>"
                >
                <label class="form-check-label" for="<?php echo e($tableName); ?>-filter-<?php echo e($filter->getKey()); ?><?php if($filter->hasCustomPosition()): ?>-<?php echo e($filter->getCustomPosition()); ?><?php endif; ?>-<?php echo e($loop->index); ?>"><?php echo e($value); ?></label>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\rappasoft\laravel-livewire-tables\resources\views\components\tools\filters\multi-select.blade.php ENDPATH**/ ?>