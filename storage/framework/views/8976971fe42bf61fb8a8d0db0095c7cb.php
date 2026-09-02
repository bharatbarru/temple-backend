<a href="<?php echo e($route); ?>" class="btn btn-default"
    onclick="event.preventDefault();
    Swal.fire({
        title: 'Are you sure to go back?',
        text: 'All data entered will be lost',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?php echo e($route); ?>';
        }
    });">
    Cancel
</a><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\common\cancel-button-with-sweet-alert.blade.php ENDPATH**/ ?>