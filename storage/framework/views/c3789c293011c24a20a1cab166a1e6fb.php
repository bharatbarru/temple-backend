<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Media Library</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <form class="mb-4" method="POST" action="<?php echo e(url('admin/upload-media')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="input-group">
                        <input type="file" name="image[]" class="form-control" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                        <button type="submit" class="btn btn-primary">Upload Files</button>
                    </div>
                </form>

                <div class="row">
                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 col-sm-4 mb-3">
                            <div class="gallery-block">
                                <a href="<?php echo e(url('admin/remove-media/' . $file['filename'])); ?>" 
                                   class="btn btn-danger btn-sm delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete <?php echo e($file['filename']); ?>?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                
                                <span class="copy-url" 
                                      onclick="copyToClipboard('<?php echo e(asset('images/media/' . $file['filename'])); ?>')"
                                      title="Click to copy URL">
                                    Copy URL
                                </span>

                                <?php if(in_array($file['extension'], ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                    <a href="<?php echo e(asset('images/media/' . $file['filename'])); ?>" target="_blank">
                                        <img src="<?php echo e(asset('images/media/' . $file['filename'])); ?>" 
                                             alt="<?php echo e($file['filename']); ?>" 
                                             class="img-fluid">
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(asset('images/media/' . $file['filename'])); ?>" 
                                       target="_blank" 
                                       class="file-preview">
                                        <span><?php echo e(strtoupper($file['extension'])); ?><br><?php echo e($file['filename']); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
<script>
    // Configure Toastr options
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 3000
    };

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            toastr.success('URL copied to clipboard!');
        }).catch(err => {
            toastr.error('Failed to copy URL');
            console.error('Failed to copy: ', err);
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\media.blade.php ENDPATH**/ ?>