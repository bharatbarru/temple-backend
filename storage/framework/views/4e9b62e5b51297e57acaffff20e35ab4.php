/**
     * @OA\Put(
     *      path="/<?php echo e($config->modelNames->dashedPlural); ?>/{id}",
     *      summary="update<?php echo e($config->modelNames->name); ?>",
     *      tags={"<?php echo e($config->modelNames->name); ?>"},
     *      description="Update <?php echo e($config->modelNames->name); ?>",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of <?php echo e($config->modelNames->name); ?>",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
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
     */<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\swagger-generator\views\controller\update.blade.php ENDPATH**/ ?>