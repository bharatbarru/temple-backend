        if (empty($<?php echo e($config->modelNames->camel); ?>)) {
<?php if($config->options->localized): ?>
            Flash::error(__('models/<?php echo e($config->modelNames->camelPlural); ?>.singular').' '.__('messages.not_found'));
<?php else: ?>
            Flash::error('<?php echo e($config->modelNames->human); ?> not found');
<?php endif; ?>

            return redirect(route('<?php echo e($config->prefixes->getRoutePrefixWith('.')); ?><?php echo e($config->modelNames->camelPlural); ?>.index'));
        }
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\vendor\laravel-generator\scaffold\controller\model_not_found.blade.php ENDPATH**/ ?>