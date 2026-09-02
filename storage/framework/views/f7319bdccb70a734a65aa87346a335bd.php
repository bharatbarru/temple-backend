    public function <?php echo e($functionName); ?>(): \Illuminate\Database\Eloquent\Relations\<?php echo e($relationClass); ?>

    {
        return $this-><?php echo e($relation); ?>(\<?php echo e($config->namespaces->model); ?>\<?php echo e($relatedModel); ?>::class<?php echo $fields; ?>);
    }<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\model\relationship.blade.php ENDPATH**/ ?>