<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('logo')) }}"
             alt="{{ applicationSettingsAltText('logo') }}"
             class="brand-image ">
       
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
