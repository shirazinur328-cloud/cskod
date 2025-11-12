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
                            <!-- Lanjutkan Belajar -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Lanjutkan Belajar</h6>
                                </div>
                                <div class="card-body">
                                    <h5 style="color: var(--text-color);">Dasar-Dasar HTML</h5>
                                    <p style="color: var(--text-secondary-color);">Mengenal tag-tag dasar untuk membangun struktur website.</p>
                                    <div class="progress mb-3" style="height: 10px;">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <a href="#" class="btn btn-primary">Lanjutkan <i class="fas fa-arrow-right fa-sm"></i></a>
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
                            <!-- Progres Saya -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Progres Saya</h6>
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
                                            <h4 class="small font-weight-bold"><?= htmlspecialchars($mapel->nama_mapel) ?> <span class="float-right"><?= $percentage ?>%</span></h4>
                                            <div class="progress mb-4">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $percentage ?>%;" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-center small" style="color: var(--text-secondary-color);">Belum ada progres.</p>
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
