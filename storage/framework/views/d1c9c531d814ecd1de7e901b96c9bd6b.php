<div class="card callout callout-success puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Puja Info
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-danger float-right" style="color: #fff; text-decoration:none"
                    href="javascript:history.back()">
                    Back
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">

            <p class="col-md-4">Name: </p>
            <p class="col-md-8 " style="font-weight:bold"><?php echo e($puja->name); ?></p>


            <p class="col-md-4">Home Amount: </p>
            <p class="col-md-8 " style="font-weight:bold"> <?php echo e(formatAmount($puja->home_amount)); ?></p>



            <h6 class="col-md-4">Total Amount:</h6>
            <h6 class="col-md-8 " style="font-weight:bold; color:#980406"> <?php echo e(formatAmount($puja->temple_amount)); ?></h6>


        </div>
    </div>
    <!-- /.card-body -->
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pujas\show_fields.blade.php ENDPATH**/ ?>