    public function index(<?php echo e($config->modelNames->name); ?>DataTable $<?php echo e($config->modelNames->camel); ?>DataTable)
    {
    return $<?php echo e($config->modelNames->camel); ?>DataTable->render('<?php echo e($config->modelNames->snakePlural); ?>.index');
    }
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\vendor\laravel-generator\scaffold\controller\index_method_datatable.blade.php ENDPATH**/ ?>