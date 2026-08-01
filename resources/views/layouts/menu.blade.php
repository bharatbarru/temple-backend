<!-- Dashboard -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('admin/home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin/media') }}" class="nav-link {{ Request::is('admin/media*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-images"></i>
        <p>Media</p>
    </a>
</li>

<!-- Pages -->
@if (auth()->user()->hasPermissionTo('view-cms'))
    <li class="nav-item">
        <a href="{{ route('cms.index') }}" class="nav-link {{ Request::is('admin/cms*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>Pages</p>
        </a>
    </li>
@endif

@if (auth()->user()->hasPermissionTo('view-slider'))
    <li class="nav-item">
        <a href="{{ route('sliders.index') }}" class="nav-link {{ Request::is('admin/sliders*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Sliders</p>
        </a>
    </li>
@endif

<!-- Products -->
{{-- @if (auth()->user()->canAny(['view-product_categories', 'view-products']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
                Our Products
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-product_categories'))
                <li class="nav-item">
                    <a href="{{ route('productCategories.index') }}"
                        class="nav-link {{ Request::is('admin/productCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Products Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-products'))
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Products Lists</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif --}}

<!-- Blog -->
{{-- @if (auth()->user()->canAny(['view-blog_categories', 'view-blog_posts']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
                Blog
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-blog_categories'))
                <li class="nav-item">
                    <a href="{{ route('blogCategories.index') }}"
                        class="nav-link {{ Request::is('admin/blogCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-blog_posts'))
                <li class="nav-item">
                    <a href="{{ route('blogPosts.index') }}"
                        class="nav-link {{ Request::is('admin/blogPosts*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif --}}

<!-- Testimonials -->
{{-- @if (auth()->user()->canAny(['view-testimonial_categories', 'view-testimonials']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-quote-left"></i>
            <p>
                Testimonials
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-testimonial_categories'))
                <li class="nav-item">
                    <a href="{{ route('testimonialCategories.index') }}"
                        class="nav-link {{ Request::is('admin/testimonialCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-testimonials'))
                <li class="nav-item">
                    <a href="{{ route('testimonials.index') }}"
                        class="nav-link {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif --}}

<!-- Photo Gallery -->
@if (auth()->user()->canAny(['view-photo-gallery-categories', 'view-photo-galleries']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
            <p>
                Gallery
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-photo-gallery-categories'))
                <li class="nav-item">
                    <a href="{{ route('photoGalleryCategories.index') }}"
                        class="nav-link {{ Request::is('admin/photoGalleryCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-photo-galleries'))
                <li class="nav-item">
                    <a href="{{ route('photoGalleries.index') }}"
                        class="nav-link {{ Request::is('admin/photoGalleries*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

<!-- Teams -->
@if (auth()->user()->canAny(['view-team_categories', 'view-teams']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Teams
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-team_categories'))
                <li class="nav-item">
                    <a href="{{ route('teamCategories.index') }}"
                        class="nav-link {{ Request::is('admin/teamCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-teams'))
                <li class="nav-item">
                    <a href="{{ route('teams.index') }}"
                        class="nav-link {{ Request::is('admin/teams*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

<!-- Faqs -->
{{-- @if (auth()->user()->canAny(['view-faq_categories', 'view-faqs']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>
                Faqs
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-faq_categories'))
                <li class="nav-item">
                    <a href="{{ route('faqCategories.index') }}"
                        class="nav-link {{ Request::is('admin/faqCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-faqs'))
                <li class="nav-item">
                    <a href="{{ route('faqs.index') }}" class="nav-link {{ Request::is('admin/faqs*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lists</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif --}}

<!-- Statistics -->
{{-- @if (auth()->user()->hasPermissionTo('view-statistics'))
    <li class="nav-item">
        <a href="{{ route('statistics.index') }}"
            class="nav-link {{ Request::is('admin/statistics*') ? 'active' : '' }}">
            <i class="far fa-chart-bar nav-icon"></i>
            <p>Statistics</p>
        </a>
    </li>
@endif --}}

{{-- @if (auth()->user()->hasPermissionTo('news'))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
                News
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('newsCategories.index') }}"
                    class="nav-link {{ Request::is('admin/newsCategories*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>News Categories</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('news.index') }}" class="nav-link {{ Request::is('admin/news*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>News</p>
                </a>
            </li>
        </ul>
    </li>
@endif --}}

<!-- Event Management -->
@if (auth()->user()->canAny(['view-event-categories', 'view-events']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
                Event Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-event-categories'))
                <li class="nav-item">
                    <a href="{{ route('eventCategories.index') }}" class="nav-link {{ Request::is('admin/eventCategories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Event Categories</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-events'))
                <li class="nav-item">
                    <a href="{{ route('events.index') }}" class="nav-link {{ Request::is('admin/events*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Events</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (auth()->user()->hasPermissionTo('view-frontend-users'))
    <li class="nav-item">
        <a href="{{ route('frontendUsers.index') }}" class="nav-link {{ Request::is('admin/frontendUsers*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Frontend Users</p>
        </a>
    </li>
@endif

<!-- Puja Management -->
@if (auth()->user()->canAny(['view-pujas', 'view-puja-orders']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-gopuram"></i>
            <p>
                Puja Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-pujas'))
                <li class="nav-item">
                    <a href="{{ route('pujas.index') }}" class="nav-link {{ Request::is('admin/pujas*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gopuram"></i>
                        <p>Pujas</p>
                    </a>
                </li>
            @endif
            
            @if (auth()->user()->hasPermissionTo('view-puja-orders'))
                <li class="nav-item">
                    <a href="{{ route('pujaOrders.index') }}" class="nav-link {{ Request::is('admin/pujaOrders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Puja Orders</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-puja-orders'))
                <li class="nav-item">
                    <a href="{{ route('old.puja.requests') }}" class="nav-link {{ Request::is('admin/old-puja-requests*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Old Puja Requests</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

<!-- Hall Management -->
@if (auth()->user()->canAny(['view-halls', 'view-hall-addons']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
                Hall Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-halls'))
                <li class="nav-item">
                    <a href="{{ route('halls.index') }}" class="nav-link {{ Request::is('admin/halls*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Halls</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-hall-addons'))
                <li class="nav-item">
                    <a href="{{ route('hallAddons.index') }}" class="nav-link {{ Request::is('admin/hallAddons*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>Hall Addons</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-hall-event-types'))
                <li class="nav-item">
                    <a href="{{ route('hallEventTypes.index') }}" class="nav-link {{ Request::is('admin/hallEventTypes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Hall Event Types</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-hall-orders'))
                <li class="nav-item">
                    <a href="{{ route('hallOrders.index') }}" class="nav-link {{ Request::is('admin/hallOrders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Hall Orders</p>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a href="{{ route('old.hall.requests') }}" class="nav-link {{ Request::is('admin/old-hall-requests*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gopuram"></i>
                    <p>Old Hall Requests</p>
                </a>
            </li>
        </ul>
    </li>
@endif

@if (auth()->user()->hasPermissionTo('view-temple-tours'))
    <li class="nav-item">
        <a href="{{ route('templeTours.index') }}" class="nav-link {{ Request::is('admin/templeTours*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-gopuram"></i>
            <p>Temple Tour Requests</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('old.tour.requests') }}" class="nav-link {{ Request::is('admin/old-tour-requests*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-gopuram"></i>
            <p>Old Temple Tour Requests</p>
        </a>
    </li>
@endif


<!-- Online Orders -->
{{-- @if (auth()->user()->canAny(['view-payment-methods', 'view-customers', 'view-coupons', 'view-orders']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
                Online Orders
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-payment-methods'))
                <li class="nav-item">
                    <a href="{{ route('paymentMethods.index') }}" class="nav-link {{ Request::is('admin/paymentMethods*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Payment Methods</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-customers'))
                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ Request::is('admin/customers*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customers</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-coupons'))
                <li class="nav-item">
                    <a href="{{ route('coupons.index') }}" class="nav-link {{ Request::is('admin/coupons*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Coupons</p>
                    </a>
                </li>
            @endif
            
            @if (auth()->user()->hasPermissionTo('view-orders'))
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Orders</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif --}}

@if (auth()->user()->hasPermissionTo('view-application-settings'))
    <li class="nav-item">
        <a href="{{ url('admin/settings?type=theme-settings') }}"
            class="nav-link {{ request()->input('type') == 'theme-settings' ? 'active' : '' }}"> <i
                class="nav-icon fas fa-cogs"></i>
            <p>Theme Settings</p>
        </a>
    </li>
@endif

<!-- Application Settings -->
@if (auth()->user()->canAny([
            'view-application-setting-types',
            'view-application-setting-categories',
            'view-users',
            'view-application-settings',
        ]))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                Application Settings
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-application-setting-types'))
                <li class="nav-item">
                    <a href="{{ route('applicationSettingTypes.index') }}"
                        class="nav-link {{ Request::is('admin/applicationSettingTypes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Types</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-application-setting-categories'))
                <li class="nav-item">
                    <a href="{{ route('applicationSettingCategories.index') }}"
                        class="nav-link {{ Request::is('admin/applicationSettingCategories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>Categories</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-application-settings'))
                <li class="nav-item">
                    <a href="{{ route('applicationSettings.index') }}"
                        class="nav-link {{ Request::is('admin/applicationSettings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Settings</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(auth()->user()->hasPermissionTo('view-clientele_categories'))
    <li class="nav-item">
        <a href="{{ url('admin/clienteles?type=deepam') }}"
            class="nav-link {{ Request::is('admin/clienteles?type=deepam') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Deepam</p>
        </a>
    </li>
@endif
<!-- Developer Settings -->
@if (auth()->user()->canAny(['view-service-types', 'view-service-categories', 'view-clientele_categories']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Developer Settings
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-service-types'))
                <li class="nav-item">
                    <a href="{{ route('serviceTypes.index') }}"
                        class="nav-link {{ Request::is('admin/serviceTypes*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Page Service Types</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-service-categories'))
                <li class="nav-item">
                    <a href="{{ route('serviceCategories.index') }}"
                        class="nav-link {{ Request::is('admin/serviceCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Page Service Categories</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->hasPermissionTo('view-clientele_categories'))
                <li class="nav-item">
                    <a href="{{ route('clienteleCategories.index') }}"
                        class="nav-link {{ Request::is('admin/clienteleCategories*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Page Client Categories</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

<!-- User Management -->
@if (auth()->user()->canAny(['view-permissions', 'view-roles', 'view-users', 'add-users']))
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                User Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (auth()->user()->hasPermissionTo('view-permissions'))
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}"
                        class="nav-link {{ Request::is('admin/permissions*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>Permissions</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-roles'))
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}"
                        class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Roles</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('view-users'))
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

<!-- Activity Log -->
@if (auth()->user()->hasPermissionTo('view-activity-log'))
    <li class="nav-item">
        <a href="{{ url('admin/activity-log') }}"
            class="nav-link {{ Request::is('admin/activity-log') ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>Activity Log</p>
        </a>
    </li>
@endif
