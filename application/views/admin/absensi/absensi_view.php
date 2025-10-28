<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-dark font-weight-bold">Absensi Guru</h1>

    <?php if($this->session->flashdata('sukses')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('sukses'); ?>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Form Absensi Tanggal: <?= date('d F Y', strtotime($tanggal)); ?></h6>
        </div>
        <div class="card-body">
            
            <!-- Date Picker -->
            <form action="<?= site_url('admin/absensi'); ?>" method="get" class="form-inline mb-4">
                <div class="form-group">
                    <label for="tanggal" class="mr-2">Pilih Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= $tanggal; ?>">
                </div>
                <button type="submit" class="btn btn-primary ml-2">Tampilkan</button>
            </form>

            <hr>

            <!-- Attendance Form -->
            <form action="<?= site_url('admin/absensi/simpan_absensi'); ?>" method="post">
                <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nama Guru</th>
                                <th width="40%">Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_guru as $guru): ?>
                                <?php 
                                    $kehadiran = isset($daftar_hadir[$guru->id_guru]) ? $daftar_hadir[$guru->id_guru] : null;
                                    $status = $kehadiran ? $kehadiran->status : 'Hadir'; // Default to Hadir
                                    $keterangan = $kehadiran ? $kehadiran->keterangan : '';
                                ?>
                                <tr>
                                    <td><?= $guru->nama_guru; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-outline-success <?= ($status == 'Hadir') ? 'active' : '' ?>">
                                                <input type="radio" name="absensi[<?= $guru->id_guru; ?>][status]" value="Hadir" <?= ($status == 'Hadir') ? 'checked' : '' ?>> Hadir
                                            </label>
                                            <label class="btn btn-outline-warning <?= ($status == 'Sakit') ? 'active' : '' ?>">
                                                <input type="radio" name="absensi[<?= $guru->id_guru; ?>][status]" value="Sakit" <?= ($status == 'Sakit') ? 'checked' : '' ?>> Sakit
                                            </label>
                                            <label class="btn btn-outline-info <?= ($status == 'Izin') ? 'active' : '' ?>">
                                                <input type="radio" name="absensi[<?= $guru->id_guru; ?>][status]" value="Izin" <?= ($status == 'Izin') ? 'checked' : '' ?>> Izin
                                            </label>
                                            <label class="btn btn-outline-danger <?= ($status == 'Alpa') ? 'active' : '' ?>">
                                                <input type="radio" name="absensi[<?= $guru->id_guru; ?>][status]" value="Alpa" <?= ($status == 'Alpa') ? 'checked' : '' ?>> Alpa
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="absensi[<?= $guru->id_guru; ?>][keterangan]" class="form-control" value="<?= $keterangan; ?>" placeholder="Isi jika perlu...">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-3 float-right">
                    <i class="fas fa-save"></i> Simpan Absensi
                </button>
            </form>
        </div>
    </div>
</div>
