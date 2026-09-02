<?php
    $files = File::files(public_path('images/media'));
?>

<h1>Choose File</h1>

<ul>
    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="#" onclick="returnFileUrl('<?php echo e(asset('images/media/'. $file->getFilename())); ?>')">
                <?php ($extension = pathinfo($file, PATHINFO_EXTENSION)); ?>
                
                <?php if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])): ?>
                    <img src="<?php echo e(asset('images/media/'. $file->getFilename())); ?>" alt="" height="100" />
                <?php else: ?>
                    <?php echo e(basename($file)); ?>

                <?php endif; ?>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<script>
    function returnFileUrl(fileUrl) {
        var funcNum = getUrlParam('CKEditorFuncNum');
        window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
        window.close();
    }

    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);
        return (match && match.length > 1) ? match[1] : null;
    }
</script>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\browse.blade.php ENDPATH**/ ?>