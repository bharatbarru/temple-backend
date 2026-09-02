<?php $__env->startSection('content'); ?>
    <section class="pt-5">
        <div class="container">
            <div class="pt-6">
                <h2 class="text-center text-primary text-uppercase mb-5">Profile</h2>
                <!-- Flash success message -->
                <?php if(Session::has('flash_notification')): ?>
                    <?php $__currentLoopData = session('flash_notification'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-<?php echo e($message['level']); ?> alert-dismissible fade show" role="alert">
                            <?php echo $message['message']; ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="row justify-content-center mt-5">
                    <div class="col">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-10">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="profileTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-1" data-toggle="tab" href="#content-1"
                                            role="tab" aria-controls="content-1" aria-selected="true">
                                         View Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-4" data-toggle="tab" href="#content-4"
                                            role="tab" aria-controls="content-4" aria-selected="false">
                                            Edit Profile
                                        </a>
                                    </li>
                                 
                                </ul>
                            </div>
                           
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content" id="profileTabContent">
                            <div class="tab-pane fade active show" id="content-1" role="tabpanel" aria-labelledby="tab-1">
                             <div class="profile-inner card card-body shadow border-0">
                         
                                <ul class="m-0 p-0">
                                    <li class="row justify-content-start border-bottom pb-2 mb-2"><span class="font-500 mr-4 d-inlineblock col-2"> Name </span> : <?php echo e($user->name); ?></li>
                                    <li class="row justify-content-start border-bottom pb-2 mb-2"><span class="font-500 mr-4 d-inlineblock col-2"> Email Address </span> : <?php echo e($user->email); ?></li>
                                    <li class="row justify-content-start border-bottom pb-2 mb-2"><span class="font-500 mr-4 d-inlineblock col-2"> Phone </span> : <?php echo e($user->mobile); ?></li>
                                    <li class="row justify-content-start "><span class="font-500 mr-4 d-inlineblock col-2"> Adress </span> : <?php echo e($user->address); ?></li>
                                </ul>
                             </div>
                            </div>
                            <div class="tab-pane fade" id="content-4" role="tabpanel" aria-labelledby="tab-4">
                                <div class="profile-inner card card-body shadow border-0">
                                    <form method="POST" action="<?php echo e(url('update-profile')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?php echo e($user->id); ?>" />
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input name="name" class="form-control" id="name" value="<?php echo e($user->name); ?>" required>
                                              </div>
                                              <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Email address</label>
                                                <input name="email" class="form-control" id="email" value="<?php echo e($user->email); ?>" required readonly>
                                              </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="mobile" class="form-label">Phone</label>
                                                <input name="mobile" class="form-control" id="mobile" value="<?php echo e($user->mobile); ?>" required data-parsley-type="number">
                                            </div>
                                            <div class="mb-3 col-md-6" >
                                                <label for="address" class="form-label">Address</label>
                                                <textarea name="address" class="form-control" id="address" required><?php echo e($user->address); ?></textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="text-primary font-700 mt-5">Wallet Points</h3>
                <?php
                    $total = $user->getUserRoyaltyPointsTotal();
                    $used = $user->getUserRoyaltyPointsUsed();
                    $remaining = $user->getUserRoyaltyPointsRemaining();
                ?>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total
                        <span class="text-right font-700"><?php echo e(formatAmount($total)); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Used
                        <span class="text-right font-700"><?php echo e(formatAmount($used)); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="font-700">Remaining</span>
                        <span class="text-right font-700 text-primary"><?php echo e(formatAmount($remaining)); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\customers\profile.blade.php ENDPATH**/ ?>