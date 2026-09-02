    public function index(Request $request)
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camelPlural); ?> */
        $<?php echo e($config->modelNames->camelPlural); ?> = <?php echo e($config->modelNames->name); ?>::<?php echo $renderType; ?>;

        return view('<?php echo e($config->prefixes->getViewPrefixForInclude()); ?><?php echo e($config->modelNames->snakePlural); ?>.index')
            ->with('<?php echo e($config->modelNames->camelPlural); ?>', $<?php echo e($config->modelNames->camelPlural); ?>);
    }
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\vendor\laravel-generator\scaffold\controller\index_method.blade.php ENDPATH**/ ?>