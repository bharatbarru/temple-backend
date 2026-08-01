<div class='btn-group'>
    @if($showUrl  != null && auth()->user()->hasPermissionTo('view-'.$permissionName))
        <a href="{{ $showUrl }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endif

    @if($editUrl  != null && auth()->user()->hasPermissionTo('edit-'.$permissionName))
        <a href="{{ $editUrl }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endif

    @if(auth()->user()->hasPermissionTo('delete-'.$permissionName))
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
                    Livewire.emit('deleteRecord', {{ $recordId }});
                }
            });">
            <i class="fa fa-trash"></i>
        </a>
    @endif
</div>
