<?php if ($kelas) : ?>
    <table class="table table-bordered">
        <tr>
            <th>ID Kelas</th>
            <td><?= $kelas->id_kelas; ?></td>
        </tr>
        <tr>
            <th>Nama Kelas</th>
            <td><?= $kelas->nama_kelas; ?></td>
        </tr>
        <tr>
            <th>Tahun Ajaran</th>
            <td><?= $kelas->tahun_ajaran; ?></td>
        </tr>
        <tr>
            <th>Jumlah Murid</th>
            <td><?= $kelas->jumlah_murid; ?></td>
        </tr>
        <tr>
            <th>Guru Wali</th>
            <td><?= $kelas->guru_wali; ?></td>
        </tr>
    </table>

    <h6 class="mt-4">Mata Pelajaran dan Progress Rata-rata</h6>
    <?php if ($mapel_progress) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Total Tugas</th>
                        <th>Tugas Selesai (Kelas)</th>
                        <th>Progress Rata-rata (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mapel_progress as $mapel) : ?>
                        <?php
                            $total_tugas = $mapel->total_tugas_mapel;
                            $completed_tugas = $mapel->completed_tugas_mapel;
                            $percentage = ($total_tugas > 0) ? round(($completed_tugas / $total_tugas) * 100) : 0;
                        ?>
                        <tr>
                            <td><?= $mapel->nama_mapel; ?></td>
                            <td><?= $total_tugas; ?></td>
                            <td><?= $completed_tugas; ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= $percentage; ?>%;" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100">
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
        <p>Belum ada data mata pelajaran atau progress untuk kelas ini.</p>
    <?php endif; ?>

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
        <p>Belum ada data murid untuk kelas ini.</p>
    <?php endif; ?>

<?php else : ?>
    <p>Data kelas tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>