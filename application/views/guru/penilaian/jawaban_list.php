<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= htmlspecialchars($title); ?></h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jawaban Murid</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Murid</th>
                                    <th>Waktu Submit</th>
                                    <th>Status</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($daftar_jawaban)): ?>
                                    <?php $no = 1; foreach ($daftar_jawaban as $jawaban): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($jawaban->nama_murid); ?></td>
                                            <td><?= date('d M Y, H:i', strtotime($jawaban->submitted_at)); ?></td>
                                            <td>
                                                <?php
                                                    $badge_class = 'badge-secondary';
                                                    if ($jawaban->status == 'Selesai') {
                                                        $badge_class = 'badge-success';
                                                    } elseif ($jawaban->status == 'Revisi') {
                                                        $badge_class = 'badge-warning';
                                                    } elseif ($jawaban->status == 'Dinilai') {
                                                        $badge_class = 'badge-primary';
                                                    }
                                                ?>
                                                <span class="badge <?= $badge_class; ?>"><?= htmlspecialchars($jawaban->status); ?></span>
                                            </td>
                                            <td><?= htmlspecialchars($jawaban->nilai ?? '-'); ?></td>
                                            <td>
                                                <a href="<?= base_url('guru/penilaian/beri_nilai/' . $jawaban->id_tugas_murid); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Nilai / Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada murid yang mengumpulkan jawaban.</td>
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
