<?php $__env->startPush('page_css'); ?>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<?php $__env->stopPush(); ?>

<!-- Name Field -->
<div class="form-group col-sm-4 inline-lable-search">
    <?php echo Form::label('name', 'Name', ['class' => 'span-required']); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control letters-input', 'required']); ?>

</div>

<div class="table-responsive">
<table class="table">
    <thead>
     
        <tr>
            <th style="text-align:left; width: 15%;"> Permission</th>
            <th>All</th>
            <th>Add</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>View</th>
            <th>Publish</th>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="text-align:left"><?php echo e($permission->name); ?></td>
                <td><input type="checkbox" class="select-all" id="select-all-<?php echo e($permission->name); ?>"></td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input <?php echo e($permission->name); ?>-toggle" id="customSwitch<?php echo e($permission->id); ?>"
                                name="add-<?php echo e($permission->name); ?>"
                                <?php echo e(isset($role) ? ($role->hasPermissionTo('add-' . $permission->name) ? 'checked' : '') : ''); ?>>
                            <label class="custom-control-label" for="customSwitch<?php echo e($permission->id); ?>">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input <?php echo e($permission->name); ?>-toggle" id="customSwitch<?php echo e($permission->id); ?>a"
                                name="edit-<?php echo e($permission->name); ?>"
                                <?php echo e(isset($role) ? ($role->hasPermissionTo('edit-' . $permission->name) ? 'checked' : '') : ''); ?>>
                            <label class="custom-control-label" for="customSwitch<?php echo e($permission->id); ?>a">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input <?php echo e($permission->name); ?>-toggle" id="customSwitch<?php echo e($permission->id); ?>b"
                                name="delete-<?php echo e($permission->name); ?>"
                                <?php echo e(isset($role) ? ($role->hasPermissionTo('delete-' . $permission->name) ? 'checked' : '') : ''); ?>>
                            <label class="custom-control-label" for="customSwitch<?php echo e($permission->id); ?>b">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input <?php echo e($permission->name); ?>-toggle" id="customSwitch<?php echo e($permission->id); ?>c"
                                name="view-<?php echo e($permission->name); ?>"
                                <?php echo e(isset($role) ? ($role->hasPermissionTo('view-' . $permission->name) ? 'checked' : '') : ''); ?>>
                            <label class="custom-control-label" for="customSwitch<?php echo e($permission->id); ?>c">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input <?php echo e($permission->name); ?>-toggle" id="customSwitch<?php echo e($permission->id); ?>d"
                                name="publish-<?php echo e($permission->name); ?>"
                                <?php echo e(isset($role) ? ($role->hasPermissionTo('publish-' . $permission->name) ? 'checked' : '') : ''); ?>>
                            <label class="custom-control-label" for="customSwitch<?php echo e($permission->id); ?>d">&nbsp;</label>
                        </div>
                    </div>
                </td>
            </tr>

            <script type="text/javascript">
                $(function() {
                    const selectAll<?php echo e($permission->id); ?> = $('#select-all-<?php echo e($permission->name); ?>');
                    const toggles<?php echo e($permission->id); ?> = $('.<?php echo e($permission->name); ?>-toggle');

                    selectAll<?php echo e($permission->id); ?>.on('click', function() {
                        const isChecked = $(this).prop('checked');
                        toggles<?php echo e($permission->id); ?>.prop('checked', isChecked);
                    });

                    toggles<?php echo e($permission->id); ?>.on('click', function() {
                        const isChecked = toggles<?php echo e($permission->id); ?>.filter(':checked').length === toggles<?php echo e($permission->id); ?>.length;
                        selectAll<?php echo e($permission->id); ?>.prop('checked', isChecked);
                        selectAllSinglecheck();
                    });

                    var total = $('.<?php echo e($permission->name); ?>-toggle').length;
                    var checked = $('.<?php echo e($permission->name); ?>-toggle:checked').length;
                    $('#select-all-<?php echo e($permission->name); ?>').prop('checked', total == checked);
                });
            </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>
<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        function selectAllcheck(){
            const allToggles = $('.custom-control-input');
            const isAllChecked = allToggles.filter(':checked').length === allToggles.length;
            $('#select-all').prop('checked', isAllChecked);
            $('.select-all').prop('checked', isAllChecked);
        }
        function selectAllSinglecheck(){
            const allToggles = $('.custom-control-input');
            const isAllChecked = allToggles.filter(':checked').length === allToggles.length;
            $('#select-all').prop('checked', isAllChecked);
        }
        $('.icheck-primary').click(function() {
            if ($(this).is(":checked")) {
                $(this).addClass("active");
                toggleColor();
                console.log('ON');
            } else {
                $(this).removeClass("active");
                removeColor();
                console.log('OFF');
            }
        });
        
        selectAllcheck();
        $('#select-all').on('click', function() {
            const isChecked = $(this).prop('checked');
            $('.custom-control-input').prop('checked', isChecked);
            selectAllcheck();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\user-management\roles\fields.blade.php ENDPATH**/ ?>