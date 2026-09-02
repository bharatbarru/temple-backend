<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->repositoryTests); ?>;

use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;
use <?php echo e($config->namespaces->repository); ?>\<?php echo e($config->modelNames->name); ?>Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use <?php echo e($config->namespaces->tests); ?>\TestCase;
use <?php echo e($config->namespaces->tests); ?>\ApiTestTrait;

class <?php echo e($config->modelNames->name); ?>RepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected <?php echo e($config->modelNames->name); ?>Repository $<?php echo e($config->modelNames->camel); ?>Repo;

    public function setUp() : void
    {
        parent::setUp();
        $this-><?php echo e($config->modelNames->camel); ?>Repo = app(<?php echo e($config->modelNames->name); ?>Repository::class);
    }

    /**
     * @test create
     */
    public function test_create_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->make()->toArray();

        $created<?php echo e($config->modelNames->name); ?> = $this-><?php echo e($config->modelNames->camel); ?>Repo->create($<?php echo e($config->modelNames->camel); ?>);

        $created<?php echo e($config->modelNames->name); ?> = $created<?php echo e($config->modelNames->name); ?>->toArray();
        $this->assertArrayHasKey('id', $created<?php echo e($config->modelNames->name); ?>);
        $this->assertNotNull($created<?php echo e($config->modelNames->name); ?>['id'], 'Created <?php echo e($config->modelNames->name); ?> must have id specified');
        $this->assertNotNull(<?php echo e($config->modelNames->name); ?>::find($created<?php echo e($config->modelNames->name); ?>['id']), '<?php echo e($config->modelNames->name); ?> with given id must be in DB');
        $this->assertModelData($<?php echo e($config->modelNames->camel); ?>, $created<?php echo e($config->modelNames->name); ?>);
    }

    /**
     * @test read
     */
    public function test_read_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->create();

        $db<?php echo e($config->modelNames->name); ?> = $this-><?php echo e($config->modelNames->camel); ?>Repo->find($<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>);

        $db<?php echo e($config->modelNames->name); ?> = $db<?php echo e($config->modelNames->name); ?>->toArray();
        $this->assertModelData($<?php echo e($config->modelNames->camel); ?>->toArray(), $db<?php echo e($config->modelNames->name); ?>);
    }

    /**
     * @test update
     */
    public function test_update_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->create();
        $fake<?php echo e($config->modelNames->name); ?> = <?php echo e($config->modelNames->name); ?>::factory()->make()->toArray();

        $updated<?php echo e($config->modelNames->name); ?> = $this-><?php echo e($config->modelNames->camel); ?>Repo->update($fake<?php echo e($config->modelNames->name); ?>, $<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>);

        $this->assertModelData($fake<?php echo e($config->modelNames->name); ?>, $updated<?php echo e($config->modelNames->name); ?>->toArray());
        $db<?php echo e($config->modelNames->name); ?> = $this-><?php echo e($config->modelNames->camel); ?>Repo->find($<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>);
        $this->assertModelData($fake<?php echo e($config->modelNames->name); ?>, $db<?php echo e($config->modelNames->name); ?>->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->create();

        $resp = $this-><?php echo e($config->modelNames->camel); ?>Repo->delete($<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>);

        $this->assertTrue($resp);
        $this->assertNull(<?php echo e($config->modelNames->name); ?>::find($<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>), '<?php echo e($config->modelNames->name); ?> should not exist in DB');
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\vendor\laravel-generator\repository\repository_test.blade.php ENDPATH**/ ?>