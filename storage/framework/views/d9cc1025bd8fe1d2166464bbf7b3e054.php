<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['component']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['component']); ?>
<?php foreach (array_filter((['component']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $refresh = $this->getRefreshStatus();
    $theme = $component->getTheme();
?>

<div x-data="{
    <?php if($component->isFilterLayoutSlideDown()): ?> filtersOpen: $wire.filterSlideDownDefaultVisible, <?php endif; ?>
    paginationCurrentCount: $wire.entangle('paginationCurrentCount'),
    paginationTotalItemCount: $wire.entangle('paginationTotalItemCount'),
    paginationCurrentItems: $wire.entangle('paginationCurrentItems'),
    alwaysShowBulkActions: <?php echo e($component->getHideBulkActionsWhenEmptyStatus() ? 'false' : 'true'); ?>,
    selectedItems: $wire.entangle('selected').defer,
    <?php if($component->showBulkActionsDropdownAlpine()): ?>
    toggleSelectAll() {
        if (this.paginationTotalItemCount == this.selectedItems.length) {
            this.clearSelected();
        } else {
            this.setAllSelected();
        }
    },
    setAllSelected() {
        $wire.setAllSelected();
    },
    clearSelected() {
        $wire.clearSelected();
    },
    selectAllOnPage() {
        let tempSelectedItems = this.selectedItems;
        const iterator = this.paginationCurrentItems.values();
        for (const value of iterator) {
            tempSelectedItems.push(value.toString());
        }
        this.selectedItems = [...new Set(tempSelectedItems)];
    },
    <?php else: ?>
    toggleSelectAll() {
        return;
    },
    setAllSelected() {
        return;
    },
    clearSelected() {
        return;
    },
    selectAllOnPage() {
        return;
    },

    <?php endif; ?>
}">
    <div <?php echo e($attributes->merge($this->getComponentWrapperAttributes())); ?>

        <?php if($component->hasRefresh()): ?> wire:poll<?php echo e($component->getRefreshOptions()); ?> <?php endif; ?>
        <?php if($component->isFilterLayoutSlideDown()): ?> wire:ignore.self <?php endif; ?>>

        <?php echo $__env->make('livewire-tables::includes.debug', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('livewire-tables::includes.offline', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\rappasoft\laravel-livewire-tables\resources\views/components/wrapper.blade.php ENDPATH**/ ?>