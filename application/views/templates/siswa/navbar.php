<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                        <!-- Sidebar - Brand -->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('murid/dashboard') ?>">
                            <div class="sidebar-brand-icon rotate-n-15">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="sidebar-brand-text mx-3">CSKod Murid</div>
                        </a>
            
                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">
            
                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item <?php echo $this->uri->segment(2) === 'dashboard' && $this->uri->segment(3) === null ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('murid/dashboard') ?>">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                        </li>
            
                        <!-- Divider -->
                        <hr class="sidebar-divider">
            
                        <!-- Heading -->
                        <div class="sidebar-heading">
                            Pelajaran
                        </div>
            
                        <!-- Nav Item - Daftar Mapel (Dinamis) -->
                        <?php
                        // Asumsikan $mapel_murid adalah array of objects yang dikirim dari controller
                        // Setiap object memiliki properti ->id_mapel dan ->nama_mapel
                        if(isset($mapel_murid) && is_array($mapel_murid)): ?>
                            <?php foreach ($mapel_murid as $mapel): ?>
                                <li class="nav-item <?php echo (isset($current_mapel_id) && $mapel->id_mapel == $current_mapel_id) ? 'active' : ''; ?>">
                                    <a class="nav-link" href="<?php echo base_url('murid/dashboard/subject_detail/' . $mapel->id_mapel); ?>">
                                        <i class="fas fa-fw fa-book-open"></i>
                                        <span><?php echo htmlspecialchars($mapel->nama_mapel); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="nav-item">
                                <span class="nav-link">Belum ada mapel.</span>
                            </li>
                        <?php endif; ?>
            
                        <!-- Nav Item - Nilai Saya -->
                        <li class="nav-item <?php echo $this->uri->segment(3) === 'my_grades' ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('murid/dashboard/my_grades'); ?>">
                                <i class="fas fa-fw fa-star"></i>
                                <span>Nilai Saya</span>
                            </a>
                        </li>
            
                        <!-- Divider -->
                        <hr class="sidebar-divider">
            
                        <!-- Nav Item - Logout -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->