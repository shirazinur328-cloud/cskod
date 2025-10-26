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
    </table>
<?php else : ?>
    <p>Data mata pelajaran tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>