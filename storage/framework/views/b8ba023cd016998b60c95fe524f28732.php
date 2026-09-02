<?php if($config->options->localized): ?>
    Flash::success(__('messages.saved', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')]));
<?php else: ?>
    Flash::success('<?php echo e($config->modelNames->human); ?> saved successfully.');
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\scaffold\controller\messages\save_success.blade.php ENDPATH**/ ?>