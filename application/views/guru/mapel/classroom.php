<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ruang Pembelajaran: <?= $mapel->nama_mapel ?> - <?= $kelas->nama_kelas ?></h1>
        <a href="javascript:history.back()" class="btn btn-secondary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= base_url('guru/mapel/create_pertemuan/'.$id_mapel.'/'.$id_kelas); ?>" 
               class="btn btn-primary mb-4">
                <i class="fas fa-plus"></i> Buat Pertemuan
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pertemuan</h6>
                </div>
                <div class="card-body">
                    <?php if(empty($pertemuan_list)): ?>
                        <div class="alert alert-info">
                            Belum ada pertemuan untuk ruang kelas ini.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                        <td><?= $pertemuan->nama_pertemuan ?></td>
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
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->