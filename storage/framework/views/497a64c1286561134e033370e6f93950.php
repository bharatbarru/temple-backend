<div class="our-team mt-3">

        <?php
            $managementCategory = $teamCategories->where('name', 'management')->first();
            $teamsInManagementCategory = $teams->where('team_categories_id', $managementCategory->id);
        ?>

        <?php if($managementCategory && $teamsInManagementCategory->isNotEmpty()): ?>
            <div class="team-list">
                
                <div class="row mt-5">
                    <?php $__currentLoopData = $teamsInManagementCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-3">
                            <div class="card card-icon-2 justify-content-center shadow-3d text-center">
                                <figure class="m-0">
                                    <img src="<?php echo e(asset(TEAM_IMAGE_PATH . $team->image)); ?>" alt="<?php echo e($team->name); ?> Image" class="w-100">
                                </figure>
                                <div class="cards-inner p-2">
                                    <h5 class="mb-0 font-color"><?php echo e($team->name); ?></h5>
                                    <p><?php echo e($team->designation); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

  
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\management-team.blade.php ENDPATH**/ ?>