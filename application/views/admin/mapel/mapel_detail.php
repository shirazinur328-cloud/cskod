<?php if ($mapel) : ?>
    <table class="table table-bordered">
        <tr>
            <th>ID Mata Pelajaran</th>
            <td><?= $mapel->id_mapel; ?></td>
        </tr>
        <tr>
            <th>Nama Mata Pelajaran</th>
            <td><?= $mapel->nama_mapel; ?></td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td><?= $mapel->deskripsi; ?></td>
        </tr>
        <tr>
            <th>Guru Pengampu</th>
            <td><?= $mapel->guru; ?></td>
        </tr>
        <tr>
            <th>Total Pertemuan</th>
            <td><?= $mapel->total_pertemuan; ?></td>
        </tr>
        <tr>
            <th>Status Aktif</th>
            <td><?= $mapel->status_aktif == 'aktif' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>'; ?></td>
        </tr>
    </table>

    <h6 class="mt-4">Daftar Pertemuan</h6>
    <?php if ($pertemuan_list) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Nama Pertemuan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pertemuan_list as $pertemuan) : ?>
                        <tr>
                            <td><?= $pertemuan->nama_pertemuan; ?></td>
                            <td><?= $pertemuan->tanggal; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada pertemuan untuk mata pelajaran ini.</p>
    <?php endif; ?>

    <h6 class="mt-4">Daftar Tugas</h6>
    <?php if ($tugas_list) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Judul Tugas</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tugas_list as $tugas) : ?>
                        <tr>
                            <td><?= $tugas->judul_tugas; ?></td>
                            <td><?= $tugas->deadline; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada tugas untuk mata pelajaran ini.</p>
    <?php endif; ?>

    <h6 class="mt-4">Progress Rata-rata Penyelesaian Murid</h6>
    <p>Progress rata-rata: <strong><?= round($average_progress, 2); ?>%</strong></p>
    <div class="progress">
        <div class="progress-bar bg-primary" role="progressbar" style="width: <?= round($average_progress, 2); ?>%;" aria-valuenow="<?= round($average_progress, 2); ?>" aria-valuemin="0" aria-valuemax="100">
            <?= round($average_progress, 2); ?>%
        </div>
    </div>

    <hr class="mt-4">

    <h6 class="mt-4 font-weight-bold text-primary">Daftar Murid</h6>
    <?php if (!empty($daftar_murid)) : ?>
        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Nama Murid</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_murid as $murid) : ?>
                        <tr>
                            <td><?= $murid->nama_murid; ?></td>
                            <td>
                                <button class="btn btn-info btn-sm btn-murid-detail" data-id="<?= $murid->id_murid; ?>">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada murid yang terdaftar untuk mata pelajaran ini.</p>
    <?php endif; ?>

    <hr class="mt-4">

    <h6 class="mt-4 font-weight-bold text-primary">Statistik Nilai</h6>
    <?php if (!empty($statistik_nilai)) : ?>
        <table class="table table-bordered table-sm">
            <tr>
                <th>Rata-rata Nilai</th>
                <td><?= number_format($statistik_nilai->rata_rata, 2); ?></td>
            </tr>
            <tr>
                <th>Nilai Tertinggi</th>
                <td><?= $statistik_nilai->tertinggi; ?></td>
            </tr>
            <tr>
                <th>Nilai Terendah</th>
                <td><?= $statistik_nilai->terendah; ?></td>
            </tr>
        </table>
    <?php else : ?>
        <p>Belum ada data nilai untuk mata pelajaran ini.</p>
    <?php endif; ?>

    <hr class="mt-4">

    <h6 class="mt-4 font-weight-bold text-primary">Akses ke Pengaturan Sertifikat</h6>
    <p><a href="<?= site_url('admin/sertifikat?id_mapel=' . $mapel->id_mapel); ?>" class="btn btn-primary btn-sm">Kelola Sertifikat</a></p>

<?php else : ?>
    <p>Data mata pelajaran tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>