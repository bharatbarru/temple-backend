<!-- Dashboard -->
<li class="nav-item">
    <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(Request::is('admin/home') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="<?php echo e(url('admin/media')); ?>" class="nav-link <?php echo e(Request::is('admin/media*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-images"></i>
        <p>Media</p>
    </a>
</li>

<!-- Pages -->
<?php if(auth()->user()->hasPermissionTo('view-cms')): ?>
    <li class="nav-item">
        <a href="<?php echo e(route('cms.index')); ?>" class="nav-link <?php echo e(Request::is('admin/cms*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>Pages</p>
        </a>
    </li>
<?php endif; ?>

<?php if(auth()->user()->hasPermissionTo('view-slider')): ?>
    <li class="nav-item">
        <a href="<?php echo e(route('sliders.index')); ?>" class="nav-link <?php echo e(Request::is('admin/sliders*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-table"></i>
            <p>Sliders</p>
        </a>
    </li>
<?php endif; ?>

<!-- Products -->


<!-- Blog -->


<!-- Testimonials -->


<!-- Photo Gallery -->
<?php if(auth()->user()->canAny(['view-photo-gallery-categories', 'view-photo-galleries'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
            <p>
                Gallery
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-photo-gallery-categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('photoGalleryCategories.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/photoGalleryCategories*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('view-photo-galleries')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('photoGalleries.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/photoGalleries*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<!-- Teams -->
<?php if(auth()->user()->canAny(['view-team_categories', 'view-teams'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Teams
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-team_categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('teamCategories.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/teamCategories*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('view-teams')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('teams.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/teams*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<!-- Faqs -->


<!-- Statistics -->




<!-- Event Management -->
<?php if(auth()->user()->canAny(['view-event-categories', 'view-events'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
                Event Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-event-categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('eventCategories.index')); ?>" class="nav-link <?php echo e(Request::is('admin/eventCategories*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Event Categories</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-events')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('events.index')); ?>" class="nav-link <?php echo e(Request::is('admin/events*') ? 'active' : ''); ?>">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Events</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if(auth()->user()->hasPermissionTo('view-frontend-users')): ?>
    <li class="nav-item">
        <a href="<?php echo e(route('frontendUsers.index')); ?>" class="nav-link <?php echo e(Request::is('admin/frontendUsers*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Frontend Users</p>
        </a>
    </li>
<?php endif; ?>

<!-- Puja Management -->
<?php if(auth()->user()->canAny(['view-pujas', 'view-puja-orders'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-gopuram"></i>
            <p>
                Puja Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-pujas')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('pujas.index')); ?>" class="nav-link <?php echo e(Request::is('admin/pujas*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-gopuram"></i>
                        <p>Pujas</p>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(auth()->user()->hasPermissionTo('view-puja-orders')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('pujaOrders.index')); ?>" class="nav-link <?php echo e(Request::is('admin/pujaOrders*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Puja Orders</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-puja-orders')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('old.puja.requests')); ?>" class="nav-link <?php echo e(Request::is('admin/old-puja-requests*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Old Puja Requests</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<!-- Hall Management -->
<?php if(auth()->user()->canAny(['view-halls', 'view-hall-addons'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
                Hall Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-halls')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('halls.index')); ?>" class="nav-link <?php echo e(Request::is('admin/halls*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Halls</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-hall-addons')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('hallAddons.index')); ?>" class="nav-link <?php echo e(Request::is('admin/hallAddons*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>Hall Addons</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-hall-event-types')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('hallEventTypes.index')); ?>" class="nav-link <?php echo e(Request::is('admin/hallEventTypes*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Hall Event Types</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-hall-orders')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('hallOrders.index')); ?>" class="nav-link <?php echo e(Request::is('admin/hallOrders*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Hall Orders</p>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a href="<?php echo e(route('old.hall.requests')); ?>" class="nav-link <?php echo e(Request::is('admin/old-hall-requests*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-gopuram"></i>
                    <p>Old Hall Requests</p>
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>

<?php if(auth()->user()->hasPermissionTo('view-temple-tours')): ?>
    <li class="nav-item">
        <a href="<?php echo e(route('templeTours.index')); ?>" class="nav-link <?php echo e(Request::is('admin/templeTours*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-gopuram"></i>
            <p>Temple Tour Requests</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('old.tour.requests')); ?>" class="nav-link <?php echo e(Request::is('admin/old-tour-requests*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-gopuram"></i>
            <p>Old Temple Tour Requests</p>
        </a>
    </li>
<?php endif; ?>


<!-- Online Orders -->


<?php if(auth()->user()->hasPermissionTo('view-application-settings')): ?>
    <li class="nav-item">
        <a href="<?php echo e(url('admin/settings?type=theme-settings')); ?>"
            class="nav-link <?php echo e(request()->input('type') == 'theme-settings' ? 'active' : ''); ?>"> <i
                class="nav-icon fas fa-cogs"></i>
            <p>Theme Settings</p>
        </a>
    </li>
<?php endif; ?>

<!-- Application Settings -->
<?php if(auth()->user()->canAny([
            'view-application-setting-types',
            'view-application-setting-categories',
            'view-users',
            'view-application-settings',
        ])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                Application Settings
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-application-setting-types')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('applicationSettingTypes.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/applicationSettingTypes*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Types</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('view-application-setting-categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('applicationSettingCategories.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/applicationSettingCategories*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>Categories</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('view-application-settings')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('applicationSettings.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/applicationSettings*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Settings</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if(auth()->user()->hasPermissionTo('view-clientele_categories')): ?>
    <li class="nav-item">
        <a href="<?php echo e(url('admin/clienteles?type=deepam')); ?>"
            class="nav-link <?php echo e(Request::is('admin/clienteles?type=deepam') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Deepam</p>
        </a>
    </li>
<?php endif; ?>
<!-- Developer Settings -->
<?php if(auth()->user()->canAny(['view-service-types', 'view-service-categories', 'view-clientele_categories'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Developer Settings
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-service-types')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('serviceTypes.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/serviceTypes*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Page Service Types</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-service-categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('serviceCategories.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/serviceCategories*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Page Service Categories</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('view-clientele_categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('clienteleCategories.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/clienteleCategories*') ? 'active' : ''); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Page Client Categories</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<!-- User Management -->
<?php if(auth()->user()->canAny(['view-permissions', 'view-roles', 'view-users', 'add-users'])): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                User Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if(auth()->user()->hasPermissionTo('view-permissions')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('permissions.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/permissions*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>Permissions</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('view-roles')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('roles.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/roles*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Roles</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('view-users')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('users.index')); ?>"
                        class="nav-link <?php echo e(Request::is('admin/users*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<!-- Activity Log -->
<?php if(auth()->user()->hasPermissionTo('view-activity-log')): ?>
    <li class="nav-item">
        <a href="<?php echo e(url('admin/activity-log')); ?>"
            class="nav-link <?php echo e(Request::is('admin/activity-log') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-history"></i>
            <p>Activity Log</p>
        </a>
    </li>
<?php endif; ?>
<?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\resources\views/layouts/menu.blade.php ENDPATH**/ ?>