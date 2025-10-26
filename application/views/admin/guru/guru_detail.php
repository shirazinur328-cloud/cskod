<?php if ($guru) : ?>
    <table class="table table-bordered">
        <tr>
            <th>ID Guru</th>
            <td><?= $guru->id_guru; ?></td>
        </tr>
        <tr>
            <th>Nama Guru</th>
            <td><?= $guru->nama_guru; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $guru->email; ?></td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td><?= $guru->no_telp; ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= $guru->username; ?></td>
        </tr>
    </table>
<?php else : ?>
    <p>Data guru tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>