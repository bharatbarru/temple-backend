<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog Posts</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(auth()->user()->hasPermissionTo('add-blog_posts')): ?>
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('blogPosts.create')); ?>">
                        Add New
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('blog-posts-table', [])->html();
} elseif ($_instance->childHasBeenRendered('LYr94UV')) {
    $componentId = $_instance->getRenderedChildComponentId('LYr94UV');
    $componentTag = $_instance->getRenderedChildComponentTagName('LYr94UV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('LYr94UV');
} else {
    $response = \Livewire\Livewire::mount('blog-posts-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('LYr94UV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\blog_posts\index.blade.php ENDPATH**/ ?>