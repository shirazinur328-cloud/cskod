<?php if ($sertifikat) : ?>
    <table class="table table-bordered">
        <tr>
            <th>ID Sertifikat</th>
            <td><?= $sertifikat->id_sertifikat; ?></td>
        </tr>
        <tr>
            <th>Nama Sertifikat</th>
            <td><?= $sertifikat->nama_sertifikat; ?></td>
        </tr>
        <tr>
            <th>Mata Pelajaran</th>
            <td><?= $sertifikat->nama_mapel; ?></td>
        </tr>
        <tr>
            <th>Tanggal Diterbitkan</th>
            <td><?= $sertifikat->tanggal_diterbitkan; ?></td>
        </tr>
        <tr>
            <th>Template File</th>
            <td>
                <?php if ($sertifikat->template_file) : ?>
                    <a href="<?= site_url('admin/sertifikat/preview_sertifikat/' . $sertifikat->id_sertifikat); ?>" target="_blank" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                    <a href="<?= base_url('uploads/sertifikat_templates/' . $sertifikat->template_file); ?>" download class="btn btn-sm btn-success">
                        <i class="fas fa-download"></i> Download
                    </a>
                <?php else : ?>
                    Tidak ada template
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Jumlah Keluar</th>
            <td><?= $sertifikat->jumlah_keluar; ?></td>
        </tr>
    </table>

    <h6 class="mt-4">Log Sertifikat Murid</h6>
    <?php if ($issued_certificates) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID Murid</th>
                        <th>Nama Murid</th>
                        <th>Email</th>
                        <th>Tanggal Dikeluarkan</th>
                        <th>Status Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($issued_certificates as $cert) : ?>
                        <tr>
                            <td><?= $cert->id_murid; ?></td>
                            <td><?= $cert->nama_murid; ?></td>
                            <td><?= $cert->email; ?></td>
                            <td><?= $cert->tanggal_dikeluarkan; ?></td>
                            <td><?= $cert->status_validasi; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= site_url('admin/sertifikat/download_log/' . $sertifikat->id_sertifikat); ?>" class="btn btn-primary btn-sm mt-3">
            <i class="fas fa-download"></i> Download Log CSV
        </a>
    <?php else : ?>
        <p>Belum ada sertifikat yang dikeluarkan untuk template ini.</p>
    <?php endif; ?>

<?php else : ?>
    <p>Data sertifikat tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>