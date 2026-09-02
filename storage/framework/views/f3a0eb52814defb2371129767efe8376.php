/**
     * @OA\Get(
     *      path="/<?php echo e($config->modelNames->dashedPlural); ?>/{id}",
     *      summary="get<?php echo e($config->modelNames->name); ?>Item",
     *      tags={"<?php echo e($config->modelNames->name); ?>"},
     *      description="Get <?php echo e($config->modelNames->name); ?>",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of <?php echo e($config->modelNames->name); ?>",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
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
     */<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\swagger-generator\views\controller\show.blade.php ENDPATH**/ ?>