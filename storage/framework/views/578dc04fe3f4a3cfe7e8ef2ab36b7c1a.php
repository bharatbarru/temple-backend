/**
     * @OA\Post(
     *      path="/<?php echo e($config->modelNames->dashedPlural); ?>",
     *      summary="create<?php echo e($config->modelNames->name); ?>",
     *      tags={"<?php echo e($config->modelNames->name); ?>"},
     *      description="Create <?php echo e($config->modelNames->name); ?>",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/<?php echo e($config->modelNames->name); ?>")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/<?php echo e($config->modelNames->name); ?>"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\swagger-generator\views\controller\store.blade.php ENDPATH**/ ?>