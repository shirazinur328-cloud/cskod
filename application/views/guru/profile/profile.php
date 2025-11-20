<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card with Header Banner -->
            <div class="card shadow mb-4" style="border-radius: 24px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.05); !important;">
                <!-- Header Banner with Gradient -->
                <div class="profile-header" style="height: 90px; background: linear-gradient(90deg, #FFF4C2, #FFE89C);"></div>

                <!-- Profile Card Body -->
                <div class="card-body text-center position-relative" style="border-radius: 24px; padding-top: 40px; background-color: #fff;">
                    <!-- Profile Image -->
                    <img class="img-profile avatar-guru mb-3"
                         src="<?= base_url('assets/img/undraw_profile.svg'); ?>"
                         alt="Foto Profil"
                         style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #FACC15; border-radius: 50%;">

                    <!-- Name and Role -->
                    <h5 class="card-title font-weight-bold" style="color: #1E293B; font-size: 1.25rem;"><?= htmlspecialchars($guru->nama_guru); ?></h5>
                    <span class="badge badge-warning-custom text-dark mb-3 px-3 py-1"
                          style="background-color: #FEF3C7; color: #92400E; border-radius: 20px; font-size: 0.8rem;">GURU</span>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-warning-custom btn-sm px-4 py-2 flex-fill"
                           style="background-color: #FACC15; color: #000; border: none; border-radius: 50px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); transition: all 0.3s ease;"
                           data-toggle="modal" data-target="#editProfileModal">
                            Edit Profil
                        </a>
                        <a href="#" class="btn btn-outline-dark btn-sm px-4 py-2 flex-fill"
                           style="border-radius: 50px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); transition: all 0.3s ease;"
                           data-toggle="modal" data-target="#changePasswordModal">
                            Ganti Password
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4" style="border-radius: 24px; box-shadow: 0 8px 20px rgba(0,0,0,0.05); !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="border-top-left-radius: 24px; border-top-right-radius: 24px;">
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
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab" style="animation: fadeIn 0.15s ease-in, slideIn 0.15s ease-out;">
                            <h5 class="mb-3">Informasi Pribadi</h5>
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="fas fa-user text-muted mr-2"></i>
                                    <span class="text-gray-700">Nama Lengkap:</span>
                                </div>
                                <div class="col-md-8 font-weight-bold" style="color: #1E293B;"> <?= htmlspecialchars($guru->nama_guru); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="fas fa-envelope text-muted mr-2"></i>
                                    <span class="text-gray-700">Email:</span>
                                </div>
                                <div class="col-md-8 font-weight-bold" style="color: #1E293B;"> <?= htmlspecialchars($guru->email); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="fas fa-phone text-muted mr-2"></i>
                                    <span class="text-gray-700">No. HP:</span>
                                </div>
                                <div class="col-md-8 font-weight-bold" style="color: #1E293B;"> <?= htmlspecialchars($guru->no_telp); ?></div>
                            </div>
                        </div>

                        <!-- Tab Akun & Keamanan -->
                        <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab" style="animation: fadeIn 0.15s ease-in, slideIn 0.15s ease-out;">
                            <h5 class="mb-3">Pengaturan Akun & Keamanan</h5>
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="fas fa-user-circle text-muted mr-2"></i>
                                    <span class="text-gray-700">Username:</span>
                                </div>
                                <div class="col-md-8 font-weight-bold" style="color: #1E293B;"> <?= htmlspecialchars($guru->username); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="fas fa-lock text-muted mr-2"></i>
                                    <span class="text-gray-700">Password:</span>
                                </div>
                                <div class="col-md-8">
                                    <span class="font-weight-bold" style="color: #1E293B;">********</span>
                                    <a href="#" class="btn btn-link btn-sm ml-2 p-0" data-toggle="modal" data-target="#changePasswordModal">Ganti Password</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="fas fa-shield-alt text-muted mr-2"></i>
                                    <span class="text-gray-700">Verifikasi 2 Langkah:</span>
                                </div>
                                <div class="col-md-8">
                                    <span class="font-weight-bold" style="color: #1E293B;">Tidak Aktif</span>
                                    <a href="#" class="btn btn-link btn-sm ml-2 p-0">Aktifkan</a>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Aktivitas Mengajar -->
                        <div class="tab-pane fade" id="aktivitas" role="tabpanel" aria-labelledby="aktivitas-tab" style="animation: fadeIn 0.15s ease-in, slideIn 0.15s ease-out;">
                            <h5 class="mb-3">Statistik Aktivitas Mengajar</h5>
                            <div class="row mb-2">
                                <div class="col-md-6 d-flex align-items-center">
                                    <i class="fas fa-chalkboard text-muted mr-2"></i>
                                    <span class="text-gray-700">Jumlah Kelas Diajar:</span>
                                </div>
                                <div class="col-md-6 font-weight-bold" style="color: #1E293B;"> <?= $total_kelas_diajar ?? 0; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 d-flex align-items-center">
                                    <i class="fas fa-tasks text-muted mr-2"></i>
                                    <span class="text-gray-700">Jumlah Tugas Dibuat:</span>
                                </div>
                                <div class="col-md-6 font-weight-bold" style="color: #1E293B;"> <?= $total_tugas_dibuat ?? 0; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12"><strong style="color: #1E293B;">Rata-rata Nilai Siswa per Mapel:</strong></div>
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
