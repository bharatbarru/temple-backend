<?php $__env->startSection('content'); ?>
    
    
    <section class="team-details">
    <div class="container">


<div class="row align-items-center">
    <div class="left-team"> 
    <figure>
        <img src="<?php echo e(asset(TEAM_IMAGE_PATH . $team->image)); ?>"
        alt="<?php echo e($team->name); ?> Image " class="img-fluid m-auto"></figure>
      
    
    </div>
    <div class="col right-team">
        <nav  aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(url('/')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo e(url('/our-dentists')); ?>"><?php echo applicationSettings('team-title'); ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($team->name); ?></li>
            </ol>
        </nav>
        
        <h1 class="display-3 text-primary"><?php echo e($team->name); ?></h1>
        <p class="h4"><?php echo e($team->designation); ?></p></div>

    <div class="col-md-12 bottom-team"><?php echo $team->description; ?></div>


</div>



       
    </div>
      
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\team-details.blade.php ENDPATH**/ ?>