<?php if ($guru) : ?>
    <table class="table table-bordered">
        <tr>
            <th>ID Guru</th>
            <td><?= $guru->id_guru; ?></td>
        </tr>
        <tr>
            <th>Nama Guru</th>
            <td><?= $guru->nama_guru; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $guru->email; ?></td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td><?= $guru->no_telp; ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= $guru->username; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $guru->status == 'aktif' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>'; ?></td>
        </tr>
    </table>

    <h6 class="mt-4">Absensi Guru</h6>
    <?php if ($absensi_data) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absensi_data as $absensi) : ?>
                        <tr>
                            <td><?= $absensi->tanggal; ?></td>
                            <td><?= $absensi->status; ?></td>
                            <td><?= $absensi->keterangan; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada data absensi untuk guru ini.</p>
    <?php endif; ?>

    <h6 class="mt-4 font-weight-bold text-primary">Performa Mata Pelajaran yang Diajar</h6>
    <?php if (!empty($performa_kelas)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Jumlah Tugas</th>
                        <th>Jumlah Submission</th>
                        <th>Rata-rata Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($performa_kelas as $performa) : ?>
                        <tr>
                            <td><?= $performa->nama_mapel; ?></td>
                            <td><?= $performa->jumlah_tugas; ?></td>
                            <td><?= $performa->jumlah_submission; ?></td>
                            <td><?= $performa->rata_rata_nilai ? number_format($performa->rata_rata_nilai, 2) : '-'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada data performa mata pelajaran untuk guru ini.</p>
    <?php endif; ?>

<?php else : ?>
    <p>Data guru tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>