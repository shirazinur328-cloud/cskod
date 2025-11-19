<?php $segment2 = $this->uri->segment(2); ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LMS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($segment2 == 'dashboard' || empty($segment2)) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen Data
            </div>

            <!-- Nav Item - Guru -->
            <li class="nav-item <?= ($segment2 == 'guru') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/guru'); ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Guru</span></a>
            </li>

            <!-- Nav Item - Murid -->
            <li class="nav-item <?= ($segment2 == 'murid') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/murid'); ?>">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Murid</span></a>
            </li>

            <!-- Nav Item - Mapel -->
            <li class="nav-item <?= ($segment2 == 'mapel') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/mapel'); ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span></a>
            </li>

            <!-- Nav Item - Kelas -->
            <li class="nav-item <?= ($segment2 == 'kelas') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/kelas'); ?>">
                    <i class="fas fa-fw fa-chalkboard"></i>
                    <span>Kelas</span></a>
            </li>

            <!-- Nav Item - Sertifikat -->
            <!-- <li class="nav-item <?= ($segment2 == 'sertifikat') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/sertifikat'); ?>">
                    <i class="fas fa-fw fa-certificate"></i>
                    <span>Sertifikat</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Laporan
            </div> -->

            <!-- Nav Item - Absensi -->
            <!-- <li class="nav-item <?= ($segment2 == 'absensi') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensi" aria-expanded="true" aria-controls="collapseAbsensi">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Absensi Guru</span>
                </a>
                <div id="collapseAbsensi" class="collapse <?= ($segment2 == 'absensi') ? 'show' : '' ?>" aria-labelledby="headingAbsensi" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Absensi:</h6>
                        <a class="collapse-item" href="<?= base_url('admin/absensi'); ?>">Form Absensi</a>
                        <a class="collapse-item" href="<?= base_url('admin/absensi/statistik'); ?>">Statistik Absensi</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

         

        </ul>
        <!-- End of Sidebar -->