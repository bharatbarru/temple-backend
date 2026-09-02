<div class="container">
    <div class="card">
        <div class="card-body">
            <h1>
                Decline Order - <?php echo e($order->orderid); ?>

            </h1>

            <?php echo Form::open(['route' => 'order.decline']); ?>


            <div class="row">
                <input type="hidden" name="id" value="<?php echo e($order->id); ?>">

                <div class="form-group col-sm-6">
                    <?php echo Form::label('reason_for_cancellation', 'Reason For Cancellation:'); ?>

                    <?php echo Form::textarea('reason_for_cancellation', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            
            <div class="popup-buttons">
                <?php echo Form::submit('Decline Order', ['class' => 'btn btn-primary']); ?>

                <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-default"> Cancel </a>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\orders\decline.blade.php ENDPATH**/ ?>