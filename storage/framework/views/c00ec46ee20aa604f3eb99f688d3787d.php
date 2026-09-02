<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($namespaceApp); ?>Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;

/**
 * @OA\Server(url="/<?php echo e($apiPrefix); ?>")
 * @OA\Info(
 *   title="InfyOm Laravel Generator APIs",
 *   version="1.0.0"
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\vendor\laravel-generator\stubs\app_base_controller.blade.php ENDPATH**/ ?>