<?php $__env->startSection('content'); ?>






<div class="container-fluid ">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Style Guide
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="card">
        <div class="card-body">
            <ul class="page-tabs">
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=theme-settings')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'theme-settings' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Theme Settings</p>
                </a> </li>
            <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=contact-details')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'contact-details' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Contact Details</p>
                </a> </li>
            <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=socail-settings')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'socail-settings' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Socail Settings</p>
                </a> </li>
            <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=home-page-blocks')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'home-page-blocks' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Home Page Blocks</p>
                </a> </li>
                <li class="nav-item">
                    <a href="<?php echo e(url('admin/settings?type=custom-blocks')); ?>" class="nav-link <?php echo e(request()->input("type") == "custom-blocks" ? "active" : ""); ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Custom Blocks</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(url('admin/settings?type=footer')); ?>" class="nav-link <?php echo e(request()->input("type") == "footer" ? "active" : ""); ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Footer</p>
                    </a>
                </li>
            <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=meta-settings')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'meta-settings' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Meta Settings</p>
                </a> </li>
            <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=site-verification')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'site-verification' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Site Verification</p>
                </a> </li>
            <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=template-settings')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'template-settings' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Template Settings</p>
                </a> </li>
                <li class="nav-item">
                    <a href="<?php echo e(url('admin/style-guide')); ?>" class="nav-link <?php echo e(request()->is('admin/style-guide*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Style Guide</p>
                    </a>
                </li>
                            
            </ul>

            <div class="style-guide">

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-muted">Display headings</h2>
                        <!-- Loop for display headings -->
                        <script>
                            for (let i = 1; i <= 4; i++) {
                                document.write(`
                                    <div class="display-${i}">Display ${i}
                                        <i class="material-symbols-outlined click-to-copy" onclick="copyText('${i}')">content_copy</i>
                                        <span class="d-block">&lt;div class="display-${i}"&gt;Display ${i}&lt;/div&gt;</span>
                                    </div>
                                `);
                            }
                        </script>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-muted">Headings</h2>
                        <!-- Loop for headings -->
                        <script>
                            const headings = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
                            headings.forEach((heading, index) => {
                                const num = index + 5;
                                document.write(`
                                    <${heading}>${heading}.  heading
                                        <i class="material-symbols-outlined click-to-copy" onclick="copyText('${num}')">content_copy</i>
                                        <span class="d-block">&lt;${heading}&gt;heading ${num - 4}&lt;/${heading}&gt;</span>
                                    </${heading}>
                                `);
                            });
                        </script>
                        <!-- Paragraph -->
                        <p>Paragraph
                            <i class="material-symbols-outlined click-to-copy" onclick="copyText('11')">content_copy</i>
                            <span class="d-block">&lt;p&gt;Paragraph&lt;/p&gt;</span>
                        </p>
                    </div>

                    <div class="col-md-12 mt-3">
                        <h2 class="text-muted">Colors</h2> 
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-body color-primary text-center">Primay Color (#FDB917)</div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body color-tertiary text-center">Tertiary Color (#D56528)</div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body color-link text-center text-light">Link Color (#000000)</div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body color-font text-center text-light">Font Color (#43121D)</div>
                            </div>
                        </div>

                    </div>


                </div>


</div>

        </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\style-guide.blade.php ENDPATH**/ ?>