<?php if ($murid) : ?>
    <table class="table table-bordered">
        <tr>
            <th>ID Murid</th>
            <td><?= $murid->id_murid; ?></td>
        </tr>
        <tr>
            <th>Nama Murid</th>
            <td><?= $murid->nama_murid; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $murid->email; ?></td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td><?= $murid->no_telp; ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= $murid->username; ?></td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td><?= $murid->nama_kelas; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $murid->status == 'aktif' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-info">Lulus</span>'; ?></td>
        </tr>
    </table>

    <h6 class="mt-4">Progress Per Mata Pelajaran</h6>
    <?php if ($progress_per_mapel) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Total Tugas</th>
                        <th>Tugas Selesai</th>
                        <th>Progress (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($progress_per_mapel as $progress) : ?>
                        <?php
                            $total_tugas = $progress->total_tugas_mapel;
                            $completed_tugas = $progress->completed_tugas_mapel;
                            $percentage = ($total_tugas > 0) ? round(($completed_tugas / $total_tugas) * 100) : 0;
                        ?>
                        <tr>
                            <td><?= $progress->nama_mapel; ?></td>
                            <td><?= $total_tugas; ?></td>
                            <td><?= $completed_tugas; ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percentage; ?>%;" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $percentage; ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada data progress per mata pelajaran untuk murid ini.</p>
    <?php endif; ?>

    <hr class="mt-4">

    <h6 class="mt-4 font-weight-bold text-primary">Daftar Nilai</h6>
    <?php if (!empty($daftar_nilai)) : ?>
        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Judul Tugas</th>
                        <th>Nilai</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_nilai as $nilai) : ?>
                        <tr>
                            <td><?= $nilai->nama_mapel; ?></td>
                            <td><?= $nilai->judul_tugas; ?></td>
                            <td><span class="badge badge-primary"><?= $nilai->nilai; ?></span></td>
                            <td><?= date('d M Y', strtotime($nilai->tanggal_nilai)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>Belum ada data nilai untuk murid ini.</p>
    <?php endif; ?>

    <hr class="mt-4">

    

<?php else : ?>
    <p>Data murid tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>