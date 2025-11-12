<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nilai Saya</h1>
        <a href="javascript:history.back()" class="btn btn-secondary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Nilai Tugas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                    <th>Komentar Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($daftar_nilai)): ?>
                                    <?php $no = 1; foreach ($daftar_nilai as $nilai): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($nilai->judul_tugas); ?></td>
                                            <td><?= htmlspecialchars($nilai->nama_mapel); ?></td>
                                            <td><?= htmlspecialchars($nilai->nama_kelas); ?></td>
                                            <td><?= htmlspecialchars($nilai->nilai ?? '-'); ?></td>
                                            <td>
                                                <?php
                                                    $badge_class = 'badge-secondary';
                                                    if ($nilai->status == 'Dinilai') {
                                                        $badge_class = 'badge-success';
                                                    } elseif ($nilai->status == 'Revisi') {
                                                        $badge_class = 'badge-warning';
                                                    }
                                                ?>
                                                <span class="badge <?= $badge_class; ?>"><?= htmlspecialchars($nilai->status); ?></span>
                                            </td>
                                            <td><?= nl2br(htmlspecialchars($nilai->komentar_guru ?? '-')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada nilai tugas yang tersedia.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
