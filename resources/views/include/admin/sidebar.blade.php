<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">GOR Purwawidjaya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.transaction') }}" class="nav-link {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.manual-booking') }}" class="nav-link {{ request()->is('admin/manual-booking') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-calendar-check"></i>
                        <p>
                            Booking Manual
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
