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
    </table>
<?php else : ?>
    <p>Data kelas tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>