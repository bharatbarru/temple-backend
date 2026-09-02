<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td>
                    <?php echo Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']); ?>

                    <div class='btn-group'>
                        <a href="<?php echo route('users.show', [$user->id]); ?>" class='btn btn-default btn-xs'>
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="<?php echo route('users.edit', [$user->id]); ?>" class='btn btn-default btn-xs'>
                            <i class="fa fa-edit"></i>
                        </a>
                        <?php echo Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\users\table.blade.php ENDPATH**/ ?>