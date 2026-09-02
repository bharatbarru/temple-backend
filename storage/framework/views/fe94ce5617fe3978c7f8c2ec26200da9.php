<div class='btn-group'>
    <a href="<?php echo e($showUrl); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="<?php echo e($editUrl); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <a class='btn btn-danger btn-xs' wire:click="deleteRecord(<?php echo e($recordId); ?>)"
       onclick="confirm('Are you sure you want to remove this Record?') || event.stopImmediatePropagation()">
        <i class="fa fa-trash"></i>
    </a>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\scaffold\table\livewire\actions.blade.php ENDPATH**/ ?>