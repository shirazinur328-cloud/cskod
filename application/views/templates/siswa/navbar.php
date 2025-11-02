<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('index.php/murid') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CSKod Murid</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $this->uri->segment(2) === 'dashboard' && $this->uri->segment(3) === null ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('index.php/murid') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Subjects
            </div>

            <!-- Nav Item - Subjects -->
            <?php 
            // We can fetch all subjects again to show in sidebar for subject detail page
            if (isset($subject) && !empty($subject)) {
                $this->load->model('Model_murid_mapel');
                $id_murid = $this->session->userdata('id_murid') ?: 1; // Default for testing
                $all_subjects = $this->Model_murid_mapel->get_subjects_by_student_id($id_murid);
                
                if (!empty($all_subjects) && is_array($all_subjects)): 
                ?>
                <?php foreach ($all_subjects as $subj_item): ?>
                <li class="nav-item <?php echo (isset($subject) && $subj_item['id_mapel'] == $subject['id_mapel']) ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo base_url('index.php/murid/dashboard/subject_detail/' . $subj_item['id_mapel']); ?>">
                        <i class="fas fa-book"></i>
                        <span><?php echo htmlspecialchars($subj_item['nama_mapel']); ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-book"></i>
                        <span>No subjects available</span>
                    </a>
                </li>
                <?php endif; ?>
            <?php } else { ?>
                <?php if (isset($mapel) && is_array($mapel)): ?>
                    <?php foreach ($mapel as $mapel_item): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/murid/dashboard/subject_detail/' . $mapel_item['id_mapel']); ?>">
                            <i class="fas fa-book"></i>
                            <span><?php echo htmlspecialchars($mapel_item['nama_mapel']); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-book"></i>
                        <span>No subjects available</span>
                    </a>
                </li>
                <?php endif; ?>
            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->