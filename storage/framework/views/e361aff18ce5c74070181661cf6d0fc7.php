<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <?php echo e($type->type); ?>

                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        
        <?php echo $__env->make('adminlte-templates::common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card general_settings">
            <ul class="page-tabs">
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=theme-settings')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'theme-settings' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Theme Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=contact-details')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'contact-details' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Contact Details</p>
                    </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=socail-settings')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'socail-settings' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Socail Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=home-page-blocks')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'home-page-blocks' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Home Page Blocks</p>
                    </a> </li>
                  
                    <li class="nav-item">
                        <a href="<?php echo e(url('admin/settings?type=footer')); ?>" class="nav-link <?php echo e(request()->input("type") == "footer" ? "active" : ""); ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Footer</p>
                        </a>
                    </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=meta-settings')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'meta-settings' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Meta Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=site-verification')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'site-verification' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Site Verification</p>
                    </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=template-settings')); ?>"
                        class="nav-link <?php echo e(request()->input('type') == 'template-settings' ? 'active' : ''); ?>"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Template Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=payment-settings')); ?>"
                    class="nav-link <?php echo e(request()->input('type') == 'payment-settings' ? 'active' : ''); ?>"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Payment Settings</p>
                </a> </li>
                <li class="nav-item"> <a href="<?php echo e(url('admin/settings?type=terms-and-conditions')); ?>" class="nav-link <?php echo e(request()->input("type") == "terms-and-conditions" ? "active" : ""); ?>"> <i class="nav-icon fas fa-cogs"></i> <p>Terms and Conditions</p> </a> </li>

             
            </ul>
            <?php echo Form::open(['url' => 'admin/update-application-settings', 'files' => true]); ?>

            <input type="hidden" name="setting_type_id" value="<?php echo e($type->id); ?>" />
            <input type="hidden" name="setting_type_slug" value="<?php echo e($type->slug); ?>" />
            <div class="card-body">
                <div class="row animation-form">
                    
                    <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php switch($setting->input_type):
                            case ('heading'): ?>
                                <div class="col-12">
                                    <h4 class="category-title"><?php echo e($setting->field_name); ?></h4>
                                </div>
                            <?php break; ?>
                            <?php case ('color'): ?>
                                <div class="form-group col-sm-4">
                                    <?php echo Form::label($setting->id, $setting->field_name); ?>

                                    <div class="input-group colorpicker" id="<?php echo e('colorpicker' . $setting->id); ?>">
                                        <input type="text" class="form-control" name="<?php echo e($setting->id); ?>"
                                            value="<?php echo e(isset($setting) ? $setting->value : ''); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square"
                                                    style="<?php echo e(isset($setting) ? 'color:' . $setting->value : ''); ?>"></i></span>
                                        </div>
                                    </div>
                                </div>
                            <?php break; ?>
                            <?php case ('textbox'): ?>
                                <div class="form-group col-sm-4">
                                    <?php echo Form::label($setting->id, $setting->field_name); ?>

                                    <?php echo Form::text($setting->id, $setting->value, ['class' => 'form-control']); ?>

                                </div>
                            <?php break; ?>
                            <?php case ('select'): ?>
                                <div class="form-group col-sm-4">
                                    <?php echo Form::label($setting->id, $setting->field_name); ?>

                                    <?php ($options = explode(',', $setting->options)); ?>
                                    <select class="form-control select2" name="<?php echo e($setting->id); ?>">
                                        <option value=""><?php echo e('Select ' . $setting->field_name); ?></option>
                                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($option); ?>"
                                                <?php echo e($option == $setting->value ? 'selected' : ''); ?>><?php echo e($option); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <?php break; ?>
                            <?php case ('radio'): ?>
                                <div class="form-group col-sm-4">
                                    <?php echo Form::label($setting->id, $setting->field_name); ?>

                                    <?php ($options = explode(',', $setting->options)); ?>
                                    <div class="radio">
                                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label>
                                                <?php echo Form::radio('radio' . $setting->id, $option, $option == $setting->value); ?>

                                                <?php echo e($option); ?>

                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php break; ?>
                            <?php case ('checkbox'): ?>
                                <div class="form-group col-sm-4">
                                    <?php echo Form::label($setting->id, $setting->field_name); ?>

                                    <?php ($options = explode(', ', $setting->options)); ?>
                                    <div class="checkbox">
                                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label>
                                                <?php echo Form::checkbox(
                                                    'checkbox' . $setting->id . '[]',
                                                    $option,
                                                    in_array(trim($option), explode(',', $setting->value)),
                                                ); ?>

                                                <?php echo e($option); ?>

                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php break; ?>
                            <?php case ('textarea-normal'): ?>
                                <div class="form-group col-sm-12">
                                    <?php echo Form::label($setting->id, $setting->field_name); ?>

                                    <?php echo Form::textarea($setting->id, $setting->value, ['class' => 'form-control']); ?>

                                </div>
                            <?php break; ?>
                            <?php case ('textarea'): ?>
                                <div class="form-group col-sm-12">
                                    <?php echo Form::label($setting->id . '-editor', $setting->field_name); ?>

                                    <?php echo Form::textarea($setting->id, $setting->value, ['class' => 'form-control', 'id' => $setting->id . '-editor']); ?>


                                    <?php echo $__env->make('common.editor', ['field' => $setting->id . '-editor'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php break; ?>
                            <?php case ('file'): ?>
                                <?php echo $__env->make('common.image.single-image', [
                                    'field_label' => $setting->field_name,
                                    'field_name' => $setting->id,
                                    'data' => $setting->value,
                                    'path' => APPLICATION_SETTING_IMAGE_PATH,
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="form-group col-sm-4">
                                    <?php echo Form::label('alt_text' . $setting->id, $setting->field_name . ' Alt Text'); ?>

                                    <?php echo Form::text('alt_text' . $setting->id, $setting->alt_text, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Image Alt Text',
                                    ]); ?>

                                </div>
                            <?php break; ?>
                            <?php case ('multiple-files'): ?>
                                <?php echo $__env->make('common.image.multiple-image', [
                                    'field_label' => $setting->field_name,
                                    'field_name' => $setting->id,
                                    'route' => 'remove-multiple-image-item/' . $setting->id . '/',
                                    'path' => APPLICATION_SETTING_IMAGE_PATH,
                                    'data' => $setting->value,
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php break; ?>
                            <?php case ('switch'): ?>
                                <div class="form-group col-sm-4">
                                    <label><?php echo e($setting->field_name); ?></label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input <?php echo e($setting->id); ?>-toggle"
                                            id="customSwitch<?php echo e($setting->id); ?>" name="switch-<?php echo e($setting->id); ?>"
                                            <?php echo e($setting->value ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="customSwitch<?php echo e($setting->id); ?>">&nbsp;</label>
                                    </div>
                                </div>
                            <?php break; ?>
                        <?php endswitch; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="card-footer">
                <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

                <a href="<?php echo e(route('applicationSettings.index')); ?>" class="btn btn-default"> Cancel </a>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        function addClassToParentDivOfElementWithText(text, className) {
            var labels = document.getElementsByTagName('label');
            for (var i = 0; i < labels.length; i++) {
                if (labels[i].textContent === text) {
                    var parentDiv = labels[i].parentNode;
                    parentDiv.classList.add("opening-hours-title-full");
                }
            }
        }
        addClassToParentDivOfElementWithText("Opening Hours Title", "form-group col-sm-4");
        function addClassToGrandparentDivOfElementWithText(text, className) {
            var labels = document.getElementsByTagName('label');
            for (var i = 0; i < labels.length; i++) {
                if (labels[i].textContent === text) {
                    var parentDiv = labels[i].parentNode;
                    var grandparentDiv = parentDiv.parentNode;
                    grandparentDiv.classList.add(className);
                }
            }
        }
        addClassToGrandparentDivOfElementWithText("Clinic Info Sub Title", "customize-general-settings");
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\application-settings\settings.blade.php ENDPATH**/ ?>