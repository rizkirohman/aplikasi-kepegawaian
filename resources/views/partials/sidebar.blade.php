<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">

        <div class="sidebar-brand-icon">
            <i class="fas fa-users"></i>
        </div>

        <div class="sidebar-brand-text mx-3">
            SDM App
        </div>

    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kepegawaian
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pegawai</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-history"></i>
            <span>Riwayat Pegawai</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-folder"></i>
            <span>Dokumen Pegawai</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Laporan -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan Pegawai</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Sistem -->
    <div class="sidebar-heading">
        Sistem
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>User</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Toggle Sidebar -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
