<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e(config('laravel_generator.namespace.repository')); ?>;

use <?php echo e(config('laravel_generator.namespace.repository')); ?>\BaseRepository;
use <?php echo e(config('laravel_generator.namespace.model')); ?>\User;

/**
 * Class UserRepository
 * @package <?php echo e(config('laravel_generator.namespace.repository')); ?>

*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return User::class;
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\scaffold\user\user_repository.blade.php ENDPATH**/ ?>