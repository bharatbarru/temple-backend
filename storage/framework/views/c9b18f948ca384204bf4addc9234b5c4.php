<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->apiResource); ?>;

use Illuminate\Http\Resources\Json\JsonResource;

class <?php echo e($config->modelNames->name); ?>Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            <?php echo $fields; ?>

        ];
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\api\resource\resource.blade.php ENDPATH**/ ?>