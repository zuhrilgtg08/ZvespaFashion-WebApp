<!-- Sidebar -->
    <ul class="navbar-nav {{ (auth()->user()->roles_type === 1) ? 'bg-gradient-primary' : 'bg-purple' }} sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-fw fa-digital-tachograph"></i>
            </div>
            <div class="sidebar-brand-text mx-3">
                Dashboard <sup>{{ (auth()->user()->roles_type === 1) ? 'admin' : 'karyawan' }}</sup>
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ isset($sbActive) && $sbActive === 'dashboard' ? 'active' : '' }}">
            <a class="nav-link" href="/admin/manage_dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Data
        </div>

        @if (auth()->user()->roles_type == 2)
            @can('karyawan')
            <!-- NavItem - Karyawan -->
                <li class="nav-item">
                    <a class="nav-link {{ isset($sbMaster) && $sbMaster === true ? '' : 'collapsed'}}" href="#" data-toggle="collapse"
                        data-target="#collapsePages" aria-expanded="{{ isset($sbMaster) && $sbMaster === true ? 'true' : 'false' }}"
                        aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Builder Data</span>
                    </a>
                    <div id="collapsePages" class="collapse {{ isset($sbMaster) && $sbMaster === true ? 'show' : '' }}"
                        aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.galei' ? 'active' : '' }}"
                                href="">Galeri</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.profile' ? 'active' : '' }}"
                                href="">Profile</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.artikel' ? 'active' : '' }}"
                                href="">Artikel</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.events' ? 'active' : '' }}"
                                href="">Event</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.porto' ? 'active' : '' }}"
                                href="">Portofolio</a>
                        </div>
                    </div>
                </li>
            @endcan
        @else
            @can('admin')
                <!-- NavItem - Admin -->
                <li class="nav-item">
                    <a class="nav-link {{ isset($sbMaster) && $sbMaster === true ? '' : 'collapsed'}}" href="#" data-toggle="collapse"
                        data-target="#collapsePages" aria-expanded="{{ isset($sbMaster) && $sbMaster === true ? 'true' : 'false' }}"
                        aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Master</span>
                    </a>
                    <div id="collapsePages" class="collapse {{ isset($sbMaster) && $sbMaster === true ? 'show' : '' }}"
                        aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.kategori' ? 'active' : '' }}"
                                href="{{ route('admin.kategori.index') }}">Kategori</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.vespa' ? 'active' : '' }}"
                                href="">Vespa</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.karyawan' ? 'active' : '' }}"
                                href="">Karyawan</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.testimoni' ? 'active' : '' }}"
                                href="">Testimonial</a>
                            <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.spesifikasi' ? 'active' : '' }}"
                                href="">Spesifikasi</a>
                        </div>
                    </div>
                </li>
            @endcan
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
<!-- End of Sidebar -->