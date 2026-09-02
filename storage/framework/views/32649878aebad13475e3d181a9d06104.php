<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="<?php echo e(route('home')); ?>" class="brand-link">
        <img src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('logo'))); ?>"
             alt="<?php echo e(applicationSettingsAltText('logo')); ?>"
             class="brand-image ">
       
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>
        </nav>
    </div>

</aside>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\layouts\sidebar.blade.php ENDPATH**/ ?>