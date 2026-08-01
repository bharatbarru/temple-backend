<div class='btn-group'>
    <?php if($showUrl  != null && auth()->user()->hasPermissionTo('view-'.$permissionName)): ?>
        <a href="<?php echo e($showUrl); ?>" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

    <?php if($editUrl  != null && auth()->user()->hasPermissionTo('edit-'.$permissionName)): ?>
        <a href="<?php echo e($editUrl); ?>" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    <?php endif; ?>

    <?php if(auth()->user()->hasPermissionTo('delete-'.$permissionName)): ?>
        <a class="btn btn-danger btn-xs"
            onclick="event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteRecord', <?php echo e($recordId); ?>);
                }
            });">
            <i class="fa fa-trash"></i>
        </a>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/common/livewire-tables/actions.blade.php ENDPATH**/ ?>