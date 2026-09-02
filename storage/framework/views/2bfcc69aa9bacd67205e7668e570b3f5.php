<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->apiTests); ?>;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use <?php echo e($config->namespaces->tests); ?>\TestCase;
use <?php echo e($config->namespaces->tests); ?>\ApiTestTrait;
use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;

class <?php echo e($config->modelNames->name); ?>ApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/<?php echo e($config->apiPrefix); ?>/<?php echo e($config->modelNames->dashedPlural); ?>', $<?php echo e($config->modelNames->camel); ?>

        );

        $this->assertApiResponse($<?php echo e($config->modelNames->camel); ?>);
    }

    /**
     * @test
     */
    public function test_read_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->create();

        $this->response = $this->json(
            'GET',
            '/<?php echo e($config->apiPrefix); ?>/<?php echo e($config->modelNames->dashedPlural); ?>/'.$<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>

        );

        $this->assertApiResponse($<?php echo e($config->modelNames->camel); ?>->toArray());
    }

    /**
     * @test
     */
    public function test_update_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->create();
        $edited<?php echo e($config->modelNames->name); ?> = <?php echo e($config->modelNames->name); ?>::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/<?php echo e($config->apiPrefix); ?>/<?php echo e($config->modelNames->dashedPlural); ?>/'.$<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>,
            $edited<?php echo e($config->modelNames->name); ?>

        );

        $this->assertApiResponse($edited<?php echo e($config->modelNames->name); ?>);
    }

    /**
     * @test
     */
    public function test_delete_<?php echo e($config->modelNames->snake); ?>()
    {
        $<?php echo e($config->modelNames->camel); ?> = <?php echo e($config->modelNames->name); ?>::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/<?php echo e($config->apiPrefix); ?>/<?php echo e($config->modelNames->dashedPlural); ?>/'.$<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>

         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/<?php echo e($config->apiPrefix); ?>/<?php echo e($config->modelNames->dashedPlural); ?>/'.$<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>

        );

        $this->response->assertStatus(404);
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\api\test\api_test.blade.php ENDPATH**/ ?>