<?php $this->load->view('templates/siswa/head', ['title' => 'Dashboard Siswa']); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->load->view('templates/siswa/navbar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('templates/siswa/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0" style="color: var(--text-color);">Dashboard</h1>
                    </div>

                    <!-- Statistic Cards Row -->
                    <div class="row">
                        <!-- Total Mapel Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--primary-color);">Total Mapel</div>
                                            <div class="h5 mb-0 font-weight-bold" style="color: var(--text-color);"><?= count($mapel_murid) ?? 0 ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x" style="color: var(--secondary-color);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tugas Selesai Card (Placeholder) -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--primary-color);">Tugas Selesai</div>
                                            <div class="h5 mb-0 font-weight-bold" style="color: var(--text-color);">5</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-double fa-2x" style="color: var(--secondary-color);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sertifikat Card (Placeholder) -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--primary-color);">Sertifikat</div>
                                            <div class="h5 mb-0 font-weight-bold" style="color: var(--text-color);">2</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-award fa-2x" style="color: var(--secondary-color);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Poin/XP Card (Placeholder) -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--primary-color);">Poin XP</div>
                                            <div class="h5 mb-0 font-weight-bold" style="color: var(--text-color);">1,250</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-star fa-2x" style="color: var(--secondary-color);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Row -->
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-8">
                            <!-- Progres Keseluruhan -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Progres Keseluruhan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-chart-line fa-3x" style="color: var(--accent-color);"></i>
                                        <h5 class="mt-3" style="color: var(--text-color);">Pencapaian Belajarmu</h5>
                                        <p class="small text-muted">Terus semangat belajar untuk mencapai tujuanmu!</p>
                                    </div>
                                    <?php
                                        // Placeholder for overall progress
                                        $overall_progress_percentage = 75; // Example value
                                    ?>
                                    <div class="progress mb-3" style="height: 20px;">
                                        <div class="progress-bar progress-bar-animated-gradient" role="progressbar" style="width: <?= $overall_progress_percentage ?>%;" aria-valuenow="<?= $overall_progress_percentage ?>" aria-valuemin="0" aria-valuemax="100">
                                            <span class="font-weight-bold text-white"><?= $overall_progress_percentage ?>% Selesai 🎉</span>
                                        </div>
                                    </div>
                                    <p class="small text-right mb-0" style="color: var(--text-secondary-color);">Progres rata-rata dari semua mata pelajaran.</p>
                                </div>
                            </div>

                            <!-- Tugas Mendatang -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Tugas Mendatang</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="font-weight-bold">Membuat Form Pendaftaran</div>
                                                <div class="small" style="color: var(--text-secondary-color);">Web Lanjutan - Deadline: Besok</div>
                                            </div>
                                            <a href="#" class="btn btn-accent btn-sm">Kerjakan</a>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="font-weight-bold">Struktur Data Array</div>
                                                <div class="small" style="color: var(--text-secondary-color);">Algoritma & Pemrograman - Deadline: 3 hari lagi</div>
                                            </div>
                                            <a href="#" class="btn btn-accent btn-sm">Kerjakan</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-4">
                            <!-- Daftar Mapel Saya -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Daftar Mapel Saya</h6>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($mapel_murid)): ?>
                                        <?php foreach ($mapel_murid as $mapel): ?>
                                            <?php
                                                $percentage = 0;
                                                if (isset($mapel->total_materi) && $mapel->total_materi > 0) {
                                                    $percentage = round(($mapel->materi_selesai / $mapel->total_materi) * 100);
                                                }
                                            ?>
                                            <a href="<?= base_url('murid/dashboard/subject_detail/' . $mapel->id_mapel) ?>" class="card mb-3 text-decoration-none text-dark">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-book fa-2x mr-3 card-mapel-header-icon"></i>
                                                        <div>
                                                            <h6 class="card-title card-mapel-header-text mb-0"><?= htmlspecialchars($mapel->nama_mapel) ?></h6>
                                                            <p class="small text-muted mb-0">Guru: <?= htmlspecialchars($mapel->nama_guru) ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar" style="width: <?= $percentage ?>%; background-color: var(--primary-color);" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="small text-right mb-0 mt-1" style="color: var(--text-secondary-color);"><?= $percentage ?>% Selesai</p>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-center small" style="color: var(--text-secondary-color);">Belum ada mata pelajaran yang diikuti.</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Sertifikat Terbaru -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Sertifikat Terbaru</h6>
                                </div>
                                <div class="card-body text-center">
                                    <i class="fas fa-award fa-3x mb-3" style="color: var(--accent-color);"></i>
                                    <p class="font-weight-bold mb-0">Dasar Pemrograman Web</p>
                                    <p class="small" style="color: var(--text-secondary-color);">Diraih pada 10 Nov 2025</p>
                                    <a href="#" class="btn btn-secondary btn-sm">Lihat Semua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php $this->load->view('templates/siswa/footer'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>
