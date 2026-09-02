<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->apiRequest); ?>;

use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;
use InfyOm\Generator\Request\APIRequest;

class Create<?php echo e($config->modelNames->name); ?>APIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return <?php echo e($config->modelNames->name); ?>::$rules;
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\api\request\create.blade.php ENDPATH**/ ?>