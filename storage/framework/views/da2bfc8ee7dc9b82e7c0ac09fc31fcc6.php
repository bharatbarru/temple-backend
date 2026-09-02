<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->controller); ?>;

<?php if(config('laravel_generator.tables') == 'datatables'): ?>
use <?php echo e($config->namespaces->dataTables); ?>\<?php echo e($config->modelNames->name); ?>DataTable;
<?php endif; ?>
use <?php echo e($config->namespaces->request); ?>\Create<?php echo e($config->modelNames->name); ?>Request;
use <?php echo e($config->namespaces->request); ?>\Update<?php echo e($config->modelNames->name); ?>Request;
use <?php echo e($config->namespaces->app); ?>\Http\Controllers\AppBaseController;
use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;
use Illuminate\Http\Request;
use Flash;

class <?php echo e($config->modelNames->name); ?>Controller extends AppBaseController
{
    /**
     * Display a listing of the <?php echo e($config->modelNames->name); ?>.
     */
    <?php echo $indexMethod; ?>


    /**
     * Show the form for creating a new <?php echo e($config->modelNames->name); ?>.
     */
    public function create()
    {
        return view('<?php echo e($config->prefixes->getViewPrefixForInclude()); ?><?php echo e($config->modelNames->snakePlural); ?>.create');
    }

    /**
     * Store a newly created <?php echo e($config->modelNames->name); ?> in storage.
     */
    public function store(Create<?php echo e($config->modelNames->name); ?>Request $request)
    {
        $input = $request->all();

        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::create($input);

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.save_success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        return redirect(route('<?php echo e($config->prefixes->getRoutePrefixWith('.')); ?><?php echo e($config->modelNames->camelPlural); ?>.index'));
    }

    /**
     * Display the specified <?php echo e($config->modelNames->name); ?>.
     */
    public function show($id)
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.not_found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        return view('<?php echo e($config->prefixes->getViewPrefixForInclude()); ?><?php echo e($config->modelNames->snakePlural); ?>.show')->with('<?php echo e($config->modelNames->camel); ?>', $<?php echo e($config->modelNames->camel); ?>);
    }

    /**
     * Show the form for editing the specified <?php echo e($config->modelNames->name); ?>.
     */
    public function edit($id)
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.not_found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        return view('<?php echo e($config->prefixes->getViewPrefixForInclude()); ?><?php echo e($config->modelNames->snakePlural); ?>.edit')->with('<?php echo e($config->modelNames->camel); ?>', $<?php echo e($config->modelNames->camel); ?>);
    }

    /**
     * Update the specified <?php echo e($config->modelNames->name); ?> in storage.
     */
    public function update($id, Update<?php echo e($config->modelNames->name); ?>Request $request)
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.not_found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        $<?php echo e($config->modelNames->camel); ?>->fill($request->all());
        $<?php echo e($config->modelNames->camel); ?>->save();

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.update_success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        return redirect(route('<?php echo e($config->prefixes->getRoutePrefixWith('.')); ?><?php echo e($config->modelNames->camelPlural); ?>.index'));
    }

    /**
     * Remove the specified <?php echo e($config->modelNames->name); ?> from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.not_found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        $<?php echo e($config->modelNames->camel); ?>->delete();

        <?php echo $__env->make('laravel-generator::scaffold.controller.messages.delete_success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        return redirect(route('<?php echo e($config->prefixes->getRoutePrefixWith('.')); ?><?php echo e($config->modelNames->camelPlural); ?>.index'));
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\scaffold\controller\controller.blade.php ENDPATH**/ ?>