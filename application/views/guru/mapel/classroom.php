<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ruang Pembelajaran: <?= htmlspecialchars($mapel->nama_mapel) ?> - <?= htmlspecialchars($kelas->nama_kelas) ?></h1>
        <a href="javascript:history.back()" class="btn btn-secondary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <!-- Tombol Buat Pertemuan -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <a href="<?= base_url('guru/mapel/create_pertemuan/'.$id_mapel.'/'.$id_kelas); ?>" 
               class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Pertemuan
            </a>
        </div>
    </div>

    <!-- Tabbed Content for Meetings and Students -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs" id="classroomTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pertemuan-tab" data-toggle="tab" href="#pertemuan-content" role="tab" aria-controls="pertemuan-content" aria-selected="true">
                        <i class="fas fa-calendar-alt mr-2"></i>Daftar Pertemuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="siswa-tab" data-toggle="tab" href="#siswa-content" role="tab" aria-controls="siswa-content" aria-selected="false">
                        <i class="fas fa-users mr-2"></i>Daftar Siswa
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="classroomTabsContent">
                <!-- Daftar Pertemuan Tab Pane -->
                <div class="tab-pane fade show active" id="pertemuan-content" role="tabpanel" aria-labelledby="pertemuan-tab">
                    <?php if(empty($pertemuan_list)): ?>
                        <div class="alert alert-info">
                            Belum ada pertemuan untuk ruang kelas ini.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTablePertemuan" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Pertemuan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pertemuan_list as $pertemuan): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pertemuan->nama_pertemuan) ?></td>
                                        <td><?= date('d M Y', strtotime($pertemuan->tanggal)) ?></td>
                                        <td>
                                            <a href="<?= base_url('guru/pertemuan/detail/'.$pertemuan->id_pertemuan); ?>" 
                                               class="btn btn-info btn-sm">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Daftar Siswa Tab Pane -->
                <div class="tab-pane fade" id="siswa-content" role="tabpanel" aria-labelledby="siswa-tab">
                    <?php $this->load->view('guru/mapel/_list_siswa_partial', ['siswa_list' => $siswa_list]); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<script>
$(document).ready(function() {
    // Inisialisasi DataTables untuk tab "Daftar Pertemuan"
    if (!$.fn.DataTable.isDataTable('#dataTablePertemuan')) {
        $('#dataTablePertemuan').DataTable();
    }

    // Event listener untuk saat tab "Daftar Siswa" diaktifkan
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        if (target === '#siswa-content') {
            // Periksa apakah DataTables sudah diinisialisasi pada tabel siswa
            if (!$.fn.DataTable.isDataTable('#dataTableSiswa')) {
                $('#dataTableSiswa').DataTable();
            } else {
                // Jika sudah diinisialisasi, mungkin perlu di-redraw jika ada perubahan data
                $('#dataTableSiswa').DataTable().columns.adjust().draw();
            }
        }
    });
});
</script>