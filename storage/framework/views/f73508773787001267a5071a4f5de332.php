<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->factory); ?>;

use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;
use Illuminate\Database\Eloquent\Factories\Factory;
<?php echo $usedRelations; ?>


class <?php echo e($config->modelNames->name); ?>Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = <?php echo e($config->modelNames->name); ?>::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        <?php echo $relations; ?>

        return [
            <?php echo $fields; ?>

        ];
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\vendor\laravel-generator\model\factory.blade.php ENDPATH**/ ?>