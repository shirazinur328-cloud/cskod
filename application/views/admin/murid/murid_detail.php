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
    </table>
<?php else : ?>
    <p>Data murid tidak ditemukan.</p>
<?php endif; ?>

<div class="modal-footer bg-light">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Tutup</span>
    </button>
</div>