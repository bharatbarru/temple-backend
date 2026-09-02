<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->apiController); ?>;

use <?php echo e($config->namespaces->apiRequest); ?>\Create<?php echo e($config->modelNames->name); ?>APIRequest;
use <?php echo e($config->namespaces->apiRequest); ?>\Update<?php echo e($config->modelNames->name); ?>APIRequest;
use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use <?php echo e($config->namespaces->app); ?>\Http\Controllers\AppBaseController;
use <?php echo e($config->namespaces->apiResource); ?>\<?php echo e($config->modelNames->name); ?>Resource;

<?php echo $docController; ?>

class <?php echo e($config->modelNames->name); ?>APIController extends AppBaseController
{
    <?php echo $docIndex; ?>

    public function index(Request $request): JsonResponse
    {
        $query = <?php echo e($config->modelNames->name); ?>::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $<?php echo e($config->modelNames->camelPlural); ?> = $query->get();

<?php if($config->options->localized): ?>
        return $this->sendResponse(
            <?php echo e($config->modelNames->name); ?>Resource::collection($<?php echo e($config->modelNames->camelPlural); ?>),
            __('messages.retrieved', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.plural')])
        );
<?php else: ?>
        return $this->sendResponse(<?php echo e($config->modelNames->name); ?>Resource::collection($<?php echo e($config->modelNames->camelPlural); ?>), '<?php echo e($config->modelNames->humanPlural); ?> retrieved successfully');
<?php endif; ?>
    }

    <?php echo $docStore; ?>

    public function store(Create<?php echo e($config->modelNames->name); ?>APIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::create($input);

<?php if($config->options->localized): ?>
        return $this->sendResponse(
            new <?php echo e($config->modelNames->name); ?>Resource($<?php echo e($config->modelNames->camel); ?>),
            __('messages.saved', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
        );
<?php else: ?>
        return $this->sendResponse(new <?php echo e($config->modelNames->name); ?>Resource($<?php echo e($config->modelNames->camel); ?>), '<?php echo e($config->modelNames->human); ?> saved successfully');
<?php endif; ?>
    }

    <?php echo $docShow; ?>

    public function show($id): JsonResponse
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        if (empty($<?php echo e($config->modelNames->camel); ?>)) {
<?php if($config->options->localized): ?>
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
            );
<?php else: ?>
            return $this->sendError('<?php echo e($config->modelNames->human); ?> not found');
<?php endif; ?>
        }

<?php if($config->options->localized): ?>
        return $this->sendResponse(
            new <?php echo e($config->modelNames->name); ?>Resource($<?php echo e($config->modelNames->camel); ?>),
            __('messages.retrieved', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
        );
<?php else: ?>
        return $this->sendResponse(new <?php echo e($config->modelNames->name); ?>Resource($<?php echo e($config->modelNames->camel); ?>), '<?php echo e($config->modelNames->human); ?> retrieved successfully');
<?php endif; ?>
    }

    <?php echo $docUpdate; ?>

    public function update($id, Update<?php echo e($config->modelNames->name); ?>APIRequest $request): JsonResponse
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        if (empty($<?php echo e($config->modelNames->camel); ?>)) {
<?php if($config->options->localized): ?>
        return $this->sendError(
            __('messages.not_found', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
        );
<?php else: ?>
            return $this->sendError('<?php echo e($config->modelNames->human); ?> not found');
<?php endif; ?>
        }

        $<?php echo e($config->modelNames->camel); ?>->fill($request->all());
        $<?php echo e($config->modelNames->camel); ?>->save();

<?php if($config->options->localized): ?>
        return $this->sendResponse(
            new <?php echo e($config->modelNames->name); ?>Resource($<?php echo e($config->modelNames->camel); ?>),
            __('messages.updated', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
        );
<?php else: ?>
        return $this->sendResponse(new <?php echo e($config->modelNames->name); ?>Resource($<?php echo e($config->modelNames->camel); ?>), '<?php echo e($config->modelNames->name); ?> updated successfully');
<?php endif; ?>
    }

    <?php echo $docDestroy; ?>

    public function destroy($id): JsonResponse
    {
        /** @var <?php echo e($config->modelNames->name); ?> $<?php echo e($config->modelNames->camel); ?> */
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::find($id);

        if (empty($<?php echo e($config->modelNames->camel); ?>)) {
<?php if($config->options->localized): ?>
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
            );
<?php else: ?>
            return $this->sendError('<?php echo e($config->modelNames->human); ?> not found');
<?php endif; ?>
        }

        $<?php echo e($config->modelNames->camel); ?>->delete();

<?php if($config->options->localized): ?>
        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')])
        );
<?php else: ?>
        return $this->sendSuccess('<?php echo e($config->modelNames->human); ?> deleted successfully');
<?php endif; ?>
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\api\controller\model\controller_resource.blade.php ENDPATH**/ ?>