
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kirim Pengumuman ke Kelas: <?= htmlspecialchars($kelas->nama_kelas) ?> (Mapel: <?= htmlspecialchars($mapel->nama_mapel) ?>)</h1>
        <a href="javascript:history.back()" class="btn btn-secondary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <!-- Form Pengumuman -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Pengumuman</h6>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('guru/mapel/send_pengumuman'); ?>" method="POST">
                <input type="hidden" name="id_mapel" value="<?= $id_mapel ?>">
                <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">

                <div class="form-group">
                    <label for="pesan_pengumuman">Pesan Pengumuman:</label>
                    <textarea class="form-control" id="pesan_pengumuman" name="pesan_pengumuman" rows="5" required></textarea>
                    <?= form_error('pesan_pengumuman', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="link_pengumuman">Link Terkait (Opsional):</label>
                    <input type="url" class="form-control" id="link_pengumuman" name="link_pengumuman" placeholder="Contoh: https://example.com/detail-materi">
                    <small class="form-text text-muted">Tambahkan link jika pengumuman ini merujuk ke halaman tertentu.</small>
                </div>

                <button type="submit" class="btn btn-primary">Kirim Pengumuman</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

