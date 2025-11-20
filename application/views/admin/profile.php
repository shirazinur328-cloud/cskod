<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" src="<?= base_url('assets/img/undraw_profile_1.svg'); ?>" alt="Foto Profil" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="card-title"><?= htmlspecialchars($admin->username); ?></h5>
                    <p class="card-text text-muted">Administrator</p>
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
                                <div class="col-md-8"><?= htmlspecialchars($admin->username ?? 'Admin'); ?></div>
                            </div>
                        </div>

                        <!-- Tab Akun & Keamanan -->
                        <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                            <h5 class="mb-3">Pengaturan Akun & Keamanan</h5>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Username:</strong></div>
                                <div class="col-md-8"><?= htmlspecialchars($admin->username); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Password:</strong></div>
                                <div class="col-md-8">******** <a href="#" class="btn btn-link btn-sm" data-toggle="modal" data-target="#changePasswordModal">Ganti Password</a></div>
                            </div>
                        </div>

                        <!-- Tab Aktivitas Mengajar -->
                        <div class="tab-pane fade" id="aktivitas" role="tabpanel" aria-labelledby="aktivitas-tab">
                            <h5 class="mb-3">Statistik Aktivitas Mengajar</h5>
                            <p class="text-muted">Tidak tersedia untuk administrator</p>
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
            <form action="<?= base_url('admin/profile/update_profile'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($admin->username); ?>" required>
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
            <form action="<?= base_url('admin/profile/ubah_password'); ?>" method="post">
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
