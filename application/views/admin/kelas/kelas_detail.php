<?php if ($kelas) : ?>
    <!-- Kelas Detail Header -->
    <div class="kelas-detail-header">
        <h3 class="mb-1"><?= $kelas->nama_kelas ?></h3>
        <p class="mb-0"><?= $kelas->tahun_ajaran ?></p>
        <p class="mb-0">Guru Wali: <?= $kelas->guru_wali ?></p>
    </div>

    <!-- Tabs Navigation -->
    <div class="kelas-detail-tabs">
        <ul class="nav nav-tabs" id="kelasTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="murid-tab" data-toggle="tab" href="#murid" role="tab" aria-controls="murid" aria-selected="true">
                    <i class="fas fa-users"></i> Murid <span class="badge badge-light"><?= $kelas->jumlah_murid ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mapel-tab" data-toggle="tab" href="#mapel" role="tab" aria-controls="mapel" aria-selected="false">
                    <i class="fas fa-book"></i> Mapel
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pertemuan-tab" data-toggle="tab" href="#pertemuan" role="tab" aria-controls="pertemuan" aria-selected="false">
                    <i class="fas fa-calendar"></i> Pertemuan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tugas-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">
                    <i class="fas fa-tasks"></i> Tugas
                </a>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="kelasTabsContent">
        <!-- Murid Tab -->
        <div class="tab-pane fade show active" id="murid" role="tabpanel" aria-labelledby="murid-tab">
            <div class="kelas-section-content">
                <h5 class="mb-3">Daftar Murid</h5>
                <?php if (!empty($daftar_murid)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Murid</th>
                                    <th width="25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($daftar_murid as $murid) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
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
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-2x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data murid untuk kelas ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mapel Tab -->
        <div class="tab-pane fade" id="mapel" role="tabpanel" aria-labelledby="mapel-tab">
            <div class="kelas-section-content">
                <h5 class="mb-3">Mata Pelajaran dan Progress Rata-rata</h5>
                <?php if ($mapel_progress) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Total Tugas</th>
                                    <th>Tugas Selesai</th>
                                    <th>Progress</th>
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
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                     style="width: <?= $percentage; ?>%;"
                                                     aria-valuenow="<?= $percentage; ?>"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
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
                    <div class="text-center py-4">
                        <i class="fas fa-book fa-2x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data mata pelajaran untuk kelas ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pertemuan Tab -->
        <div class="tab-pane fade" id="pertemuan" role="tabpanel" aria-labelledby="pertemuan-tab">
            <div class="kelas-section-content">
                <h5 class="mb-3">Pertemuan</h5>
                <div class="text-center py-4">
                    <i class="fas fa-calendar fa-2x text-muted mb-3"></i>
                    <p class="text-muted">Fitur pertemuan akan segera hadir.</p>
                </div>
            </div>
        </div>

        <!-- Tugas Tab -->
        <div class="tab-pane fade" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
            <div class="kelas-section-content">
                <h5 class="mb-3">Tugas</h5>
                <div class="text-center py-4">
                    <i class="fas fa-tasks fa-2x text-muted mb-3"></i>
                    <p class="text-muted">Fitur tugas akan segera hadir.</p>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="text-center py-4">
        <i class="fas fa-exclamation-triangle fa-2x text-muted mb-3"></i>
        <p class="text-muted">Data kelas tidak ditemukan.</p>
    </div>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>