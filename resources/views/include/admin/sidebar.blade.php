<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
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
                    <a id="dashboard-menu" href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="transaksi-menu" href="{{ route('admin.transaction') }}"
                        class="nav-link {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="booking-manual-menu" href="{{ route('admin.manual-booking') }}"
                        class="nav-link {{ request()->is('admin/manual-booking*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-calendar-check"></i>
                        <p>
                            Booking Manual
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="kelola-lapangan-menu" href="{{ route('admin.court.manage') }}"
                        class="nav-link {{ request()->is('admin/kelola-lapangan*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-table-columns"></i>
                        <p>
                            Kelola Lapangan
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/umum*') ? 'menu-is-opening menu-open' : '' }}">
                    <a id="umum-dropdown"
                        class="nav-link {{ request()->is('admin/umum*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-circle-info"></i>
                        <p>
                            Informasi Umum
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="background-color: #131313; border-radius: 4px !important;">
                        <li class="nav-item">
                            <a id="info-lomba-menu" href="{{ route('admin.competition') }}"
                                class="nav-link {{ request()->is('admin/umum/perlombaan*') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-flag-checkered"></i>
                                <p>
                                    Perlombaan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="maps-menu" href="{{ route('admin.maps') }}"
                                class="nav-link {{ request()->is('admin/umum/maps*') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-location-dot"></i>
                                <p>
                                    Google Maps
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="facility-menu" href="{{ route('admin.facility') }}"
                                class="nav-link {{ request()->is('admin/umum/fasilitas*') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                                <p>
                                    Fasilitas
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
