<div class="card callout callout-success puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Personal Information
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-danger float-right" style="color: #fff; text-decoration:none"
                    href="<?php echo e(route('frontendUsers.index')); ?>">
                    Back
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            
        <p class="col-md-4">First Name: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->first_name); ?></p>


            <p class="col-md-4">Last Name: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->last_name); ?></p>

            <p class="col-md-4">Mobile: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->mobile); ?></p>

            <p class="col-md-4">Email: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->email); ?></p>


            <p class="col-md-4">Address: </p>
            <p class="col-md-8 " style="font-weight:bold; color:#980406"><?php echo e($frontendUser->address); ?></p>

           

        </div>
    </div>
    <!-- /.card-body -->
</div>









<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Location Details
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">

            
            <p class="col-md-4">State: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->state); ?></p>


            <p class="col-md-4">City: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->city); ?></p>
    

            <p class="col-md-4">Pincode: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->pincode); ?></p>

            <p class="col-md-4">Country: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->country); ?></p>

        </div>
    </div>
    <!-- /.card-body -->
</div>






<div class="card callout callout-danger puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Astrological & Family Details
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">

            <p class="col-md-4">Dob: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->dob); ?></p>

            <p class="col-md-4">Rashi: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->rashi); ?></p>

            <p class="col-md-4">Birth Star: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->birth_star); ?></p>

            <p class="col-md-4">Gothram: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->gothram); ?></p>

            <p class="col-md-4">Spouse Name: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->spouse_name); ?></p>

            <p class="col-md-4">Children Name: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($frontendUser->children_name); ?></p>


        </div>
    </div>
    <!-- /.card-body -->
</div>


<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\frontend_users\show_fields.blade.php ENDPATH**/ ?>