<?php $this->load->view('templates/siswa/head', ['title' => 'Dashboard Siswa']); ?>



        <?php $this->load->view('templates/siswa/navbar'); ?>

        <!-- Content Wrapper -->
 

                <?php $this->load->view('templates/siswa/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0" style="color: var(--text-color);">Dashboard</h1>
                    </div>
                    <p class="mb-4" style="color: var(--text-secondary-color);">Kelas Aktif: <span class="font-weight-bold" style="color: var(--primary-color);"><?= htmlspecialchars($murid->nama_kelas ?? 'N/A') ?></span></p>

                    <!-- Statistic Cards Row -->
                    <div class="row">
                        <!-- Total Mapel Card -->
                        <div class="col-xl-4 col-md-6 mb-4">
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
                        <!-- Tugas Selesai Card -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--primary-color);">Tugas Selesai</div>
                                            <div class="h5 mb-0 font-weight-bold" style="color: var(--text-color);"><?= $tugas_selesai ?? 0 ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-double fa-2x" style="color: var(--secondary-color);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Poin/XP Card (Placeholder) -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--primary-color);">Poin XP</div>
                                            <div class="h5 mb-0 font-weight-bold" style="color: var(--text-color);"><?= $poin_xp ?? 0 ?></div>
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
                                    <div class="progress mb-3" style="height: 20px;">
                                        <div class="progress-bar progress-bar-animated-gradient" role="progressbar" style="width: <?= $overall_progress ?>%;" aria-valuenow="<?= $overall_progress ?>" aria-valuemin="0" aria-valuemax="100">
                                            <span class="font-weight-bold text-white"><?= $overall_progress ?>% Selesai 🎉</span>
                                        </div>
                                    </div>
                                    <p class="small text-right mb-0" style="color: var(--text-secondary-color);">Progres rata-rata dari semua mata pelajaran.</p>
                                </div>
                            </div>

                            <!-- Ringkasan Aktivitas Terakhir -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: var(--text-color);">Aktivitas Terakhir</h6>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($last_activity)): ?>
                                        <p class="mb-2" style="color: var(--text-color);">
                                            Kamu terakhir menyelesaikan 
                                            <span class="font-weight-bold">
                                                <?php 
                                                    if ($last_activity['type'] == 'tugas') {
                                                        echo 'Tugas: ' . htmlspecialchars($last_activity['title']);
                                                    } else {
                                                        echo 'Materi: ' . htmlspecialchars($last_activity['title']);
                                                    }
                                                ?>
                                            </span> 
                                            pada mapel <span class="font-weight-bold"><?= htmlspecialchars($last_activity['mapel_name']) ?></span>.
                                        </p>
                                        <p class="small text-muted mb-0">
                                            Pada: <?= date('d M Y H:i', strtotime($last_activity['timestamp'])) ?>
                                        </p>
                                    <?php else: ?>
                                        <p class="text-center small" style="color: var(--text-secondary-color);">Belum ada aktivitas yang tercatat.</p>
                                    <?php endif; ?>
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
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



            <?php $this->load->view('templates/siswa/footer'); ?>


</body>

</html>
