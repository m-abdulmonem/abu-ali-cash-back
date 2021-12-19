<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
            <a href="{{ admin_url("/") }}" class="nav-link {{ home_active_class(1) }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ trans("home.title") }}
                </p>
            </a>
        </li>
        <!-- ./dashboard -->
        <li class="nav-item has-treeview {{ active_class(['offers','cash-back'],0) }}">
            <a href="#" class="nav-link {{ active_class(['offers','cash-back'],1) }}">
                <i class="nav-icon fas fa-gifts"></i>
                <p>
                    {{ trans("offers.title") }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ admin_url("offers") }}" class="nav-link {{ active_class('offers',1) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans("offers.title") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ admin_url("cash-back") }}" class="nav-link {{ active_class('cash-back',1) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans("offers.cash_back_title") }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @role('super-admin|admin|writer')
            <!-- ./offers -->
            <li class="nav-item">
                <a href="{{ admin_url("categories") }}" class="nav-link {{ active_class('categories',1) }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        {{ trans("categories.title") }}
                    </p>
                </a>
            </li>
            <!-- ./categories -->
        @endrole
        @role('super-admin')
            <li class="nav-item has-treeview {{ active_class(['roles','users','permissions'],0) }}">
                <a href="{{ admin_url("users") }}" class="nav-link {{ active_class(['roles','users','permissions'],1) }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ trans("users.title") }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ admin_url("users") }}" class="nav-link {{ active_class("users",1) }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ trans("users.title") }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ admin_url("roles") }}" class="nav-link {{ active_class(['roles','permissions'],1) }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ trans("roles.permission_title") }}</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./users -->
        @endrole
        @role('super-admin|admin')
            <li class="nav-item">
                <a href="{{ admin_url("clients") }}" class="nav-link {{ active_class('clients',1) }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>{{ trans("users.clients_title") }}</p>
                </a>
            </li>
            <!-- ./clients -->
        @endrole
        @role('super-admin|admin')
            <li class="nav-item">
                <a href="{{ admin_url("settings/main") }}" class="nav-link {{ active_class(['settings/main','settings'],1) }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>{{ trans("settings.title") }}</p>
                </a>
            </li>
            <!-- ./settings -->
        @endrole
    </ul>
</nav>
<!-- /.sidebar-menu -->
