<div class="table-responsive">
    <table class="table table-bordered" id="dataTableSiswa" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Username</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($siswa_list)): ?>
                <?php $no = 1; foreach ($siswa_list as $siswa): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($siswa->nama_murid) ?></td>
                        <td><?= htmlspecialchars($siswa->username) ?></td>
                        <td><?= htmlspecialchars($siswa->email) ?></td>
                        <td><?= htmlspecialchars($siswa->no_telp) ?></td>
                        <td>
                            <span class="badge badge-<?= ($siswa->status == 'aktif') ? 'success' : 'danger' ?>">
                                <?= ucfirst(htmlspecialchars($siswa->status)) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada siswa terdaftar di kelas ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
