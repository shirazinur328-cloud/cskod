<?php $segment2 = $this->uri->segment(2); ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('guru'); ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LMS <sup>Guru</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($segment2 == 'dashboard' || empty($segment2)) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('guru/dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen Kelas
            </div>

            <?php if (!empty($tingkatan_kelas_list)): ?>
                <?php foreach ($tingkatan_kelas_list as $tingkatan_obj): ?>
                    <?php 
                        $tingkatan = $tingkatan_obj->tingkatan_kelas;
                        // New logic: Check for a controller-passed active_tingkatan, fallback to URL segment
                        $is_active = (isset($active_tingkatan) && $active_tingkatan == $tingkatan) || 
                                     ($this->uri->segment(2) == 'kelas' && $this->uri->segment(3) == $tingkatan);
                    ?>
                    <li class="nav-item <?= $is_active ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('guru/kelas/index/' . $tingkatan); ?>">
                            <i class="fas fa-fw fa-chalkboard"></i>
                            <span>Kelas <?= $tingkatan; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen Pembelajaran
            </div>

            <!-- Nav Item - Penilaian -->
            <li class="nav-item <?= ($segment2 == 'penilaian') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('guru/penilaian'); ?>">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Tugas & Penilaian</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php 
                                    $nama_guru = $this->session->userdata('nama_guru');
                                    if ($nama_guru) {
                                        echo $nama_guru;
                                    } else {
                                        echo "Guru";
                                    }
                                    ?>
                                </span>
                                <img class="img-profile avatar-guru"
                                    src="<?= base_url('assets/img/undraw_profile.svg'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('guru/profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil Saya
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->