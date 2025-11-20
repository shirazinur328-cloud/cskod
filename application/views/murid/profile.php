<!-- Begin Page Content -->
<div class="container-fluid profile-page-bg">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 profile-page-title">Profil Saya</h1>

    <div class="row">

        <!-- Kolom Kiri: Card Profil -->
        <div class="col-lg-4">
            <div class="card profile-card text-center mb-4">
                <img class="img-profile rounded-circle mb-3 mx-auto" src="<?php echo base_url('assets/img/undraw_profile.svg') ?>" alt="Foto Profil">
                <h4 class="font-weight-bold profile-name"><?php echo htmlspecialchars($murid->nama_murid); ?></h4>
                <?php /* <p class="text-muted mb-1">NIS: <?php echo htmlspecialchars($murid->nis); ?></p> */ ?>
                <p class="text-muted mb-3">Kelas: <?php echo htmlspecialchars($murid->nama_kelas ?? 'Belum ada kelas'); ?></p>
                <span class="badge status-badge mx-auto">
                    <i class="fas fa-check-circle mr-1"></i> <?php echo ucfirst(htmlspecialchars($murid->status)); ?>
                </span>
                <hr class="my-4">
                <a href="#" class="btn btn-primary btn-edit-profile btn-block" data-toggle="modal" data-target="#editProfileModal">
                    <i class="fas fa-edit mr-2"></i>Edit Profil
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Tab Informasi -->
        <div class="col-lg-8">
            <div class="card info-card">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold">Informasi & Progres Belajar</h5>
                </div>
                <div class="card-body">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="data-diri-tab" data-toggle="tab" href="#data-diri" role="tab" aria-controls="data-diri" aria-selected="true">Data Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="statistik-tab" data-toggle="tab" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Statistik Belajar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aktivitas-tab" data-toggle="tab" href="#aktivitas" role="tab" aria-controls="aktivitas" aria-selected="false">Aktivitas Terakhir</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Tab Data Diri -->
                        <div class="tab-pane fade show active" id="data-diri" role="tabpanel" aria-labelledby="data-diri-tab">
                            <div class="row mb-3">
                                <div class="col-sm-3"><h6 class="mb-0">Nama Lengkap</h6></div>
                                <div class="col-sm-9 text-secondary"><?php echo htmlspecialchars($murid->nama_murid); ?></div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                                <div class="col-sm-9 text-secondary"><?php echo htmlspecialchars($murid->email); ?></div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3"><h6 class="mb-0">No. Telepon</h6></div>
                                <div class="col-sm-9 text-secondary"><?php echo htmlspecialchars($murid->no_telp ? '(+62) ' . $murid->no_telp : '-'); ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"><h6 class="mb-0">Username</h6></div>
                                <div class="col-sm-9 text-secondary"><?php echo htmlspecialchars($murid->username); ?></div>
                            </div>
                        </div>

                        <!-- Tab Statistik Belajar -->
                        <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik-tab">
                            <h5 class="font-weight-bold mb-4">Progres Keseluruhan</h5>
                            <div class="progress mb-4" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $overall_progress; ?>%;" aria-valuenow="<?php echo $overall_progress; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $overall_progress; ?>%</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card stat-card border-left-primary h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mapel Aktif</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stats['mapel_aktif']; ?></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-book-open fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card stat-card border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tugas Selesai</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stats['tugas_selesai']; ?></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-check-double fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="card stat-card border-left-info h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nilai Rata-rata</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($stats['nilai_rata_rata'] ?? 0, 1); ?></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-star-half-alt fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Aktivitas Terakhir -->
                        <div class="tab-pane fade" id="aktivitas" role="tabpanel" aria-labelledby="aktivitas-tab">
                            <ul class="list-group list-group-flush activity-list">
                                <?php if (!empty($last_activity)) : ?>
                                    <?php foreach ($last_activity as $activity) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas <?php echo $activity->icon; ?> mr-2 <?php echo $activity->icon_color; ?>"></i>
                                                <?php echo $activity->description; ?>
                                            </div>
                                            <span class="text-muted small"><?php echo $activity->time_ago; ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li class="list-group-item">Tidak ada aktivitas terbaru.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('murid/profile/update_profile'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_murid">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_murid" name="nama_murid" value="<?= htmlspecialchars($murid->nama_murid); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($murid->email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. HP</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= htmlspecialchars($murid->no_telp); ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($murid->username); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
