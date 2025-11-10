<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pertemuan: <?= $pertemuan->nama_pertemuan ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pertemuan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Pertemuan:</strong> <?= $pertemuan->nama_pertemuan ?></p>
                            <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($pertemuan->tanggal)) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Material Section -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Materi</h6>
                    <a href="<?= base_url('guru/pertemuan/add_materi/'.$pertemuan->id_pertemuan); ?>" 
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Materi
                    </a>
                </div>
                <div class="card-body">
                    <?php if(empty($materi_list)): ?>
                        <div class="alert alert-info">
                            Belum ada materi untuk pertemuan ini.
                        </div>
                    <?php else: ?>
                        <div class="list-group">
                            <?php foreach($materi_list as $materi): ?>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="mb-1"><?= $materi->judul_materi ?></h6>
                                        <p class="mb-1 text-muted small"><?= substr($materi->deskripsi, 0, 100) ?>...</p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="<?= base_url('uploads/materi/'.$materi->file_materi); ?>" 
                                           target="_blank" class="btn btn-info btn-sm">Lihat</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Assignment Section -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tugas</h6>
                    <a href="<?= base_url('guru/pertemuan/add_tugas/'.$pertemuan->id_pertemuan); ?>" 
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Tugas
                    </a>
                </div>
                <div class="card-body">
                    <?php if(empty($tugas_list)): ?>
                        <div class="alert alert-info">
                            Belum ada tugas untuk pertemuan ini.
                        </div>
                    <?php else: ?>
                        <div class="list-group">
                            <?php foreach($tugas_list as $tugas): ?>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="mb-1"><?= $tugas->judul_tugas ?></h6>
                                        <p class="mb-1 text-muted small"><?= substr($tugas->deskripsi, 0, 100) ?>...</p>
                                        <p class="mb-0 text-muted small"><strong>Deadline:</strong> <?= date('d M Y H:i', strtotime($tugas->deadline)) ?></p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="#" class="btn btn-info btn-sm">Lihat</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->