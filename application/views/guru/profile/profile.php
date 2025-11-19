<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img class="img-profile avatar-guru mb-3" src="<?= base_url('assets/img/undraw_profile.svg'); ?>" alt="Foto Profil" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="card-title"><?= htmlspecialchars($guru->nama_guru); ?></h5>
                    <p class="card-text text-muted">Guru</p>
                    <a href="#" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#editProfileModal">Edit Profil</a>
                    <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#changePasswordModal">Ganti Password</a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <ul class="nav nav-pills" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info Pribadi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="akun-tab" data-toggle="tab" href="#akun" role="tab" aria-controls="akun" aria-selected="false">Akun & Keamanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aktivitas-tab" data-toggle="tab" href="#aktivitas" role="tab" aria-controls="aktivitas" aria-selected="false">Aktivitas Mengajar</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Tab Info Pribadi -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <h5 class="mb-3">Informasi Pribadi</h5>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Nama Lengkap:</strong></div>
                                <div class="col-md-8"><?= htmlspecialchars($guru->nama_guru); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Email:</strong></div>
                                <div class="col-md-8"><?= htmlspecialchars($guru->email); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>No. HP:</strong></div>
                                <div class="col-md-8"><?= htmlspecialchars($guru->no_telp); ?></div>
                            </div>
                        </div>

                        <!-- Tab Akun & Keamanan -->
                        <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                            <h5 class="mb-3">Pengaturan Akun & Keamanan</h5>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Username:</strong></div>
                                <div class="col-md-8"><?= htmlspecialchars($guru->username); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Password:</strong></div>
                                <div class="col-md-8">******** <a href="#" class="btn btn-link btn-sm" data-toggle="modal" data-target="#changePasswordModal">Ganti Password</a></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Verifikasi 2 Langkah:</strong></div>
                                <div class="col-md-8">Tidak Aktif <a href="#" class="btn btn-link btn-sm">Aktifkan</a></div>
                            </div>
                        </div>

                        <!-- Tab Aktivitas Mengajar -->
                        <div class="tab-pane fade" id="aktivitas" role="tabpanel" aria-labelledby="aktivitas-tab">
                            <h5 class="mb-3">Statistik Aktivitas Mengajar</h5>
                            <div class="row mb-2">
                                <div class="col-md-6"><strong>Jumlah Kelas Diajar:</strong></div>
                                <div class="col-md-6"><?= $total_kelas_diajar; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6"><strong>Jumlah Tugas Dibuat:</strong></div>
                                <div class="col-md-6"><?= $total_tugas_dibuat; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12"><strong>Rata-rata Nilai Siswa per Mapel:</strong></div>
                                <div class="col-md-12">
                                    <?php if (!empty($statistik_nilai_siswa)): ?>
                                        <ul class="list-group list-group-flush">
                                            <?php foreach ($statistik_nilai_siswa as $stat): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= htmlspecialchars($stat->nama_mapel); ?>
                                                    <span class="badge badge-primary badge-pill"><?= round($stat->rata_rata_nilai, 2); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-muted">Belum ada data statistik nilai siswa.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
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
            <form action="<?= base_url('guru/profile/update_profile'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_guru">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= htmlspecialchars($guru->nama_guru); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($guru->email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. HP</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= htmlspecialchars($guru->no_telp); ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($guru->username); ?>" required>
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

<!-- Modal Ganti Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru/profile/ubah_password'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <div class="text-danger small"><?= form_error('new_password'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
