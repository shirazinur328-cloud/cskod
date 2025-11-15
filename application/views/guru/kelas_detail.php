<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Mata Pelajaran - Kelas <?= htmlspecialchars($tingkat); ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <?php if (!empty($mapel_list)): ?>
            <?php foreach ($mapel_list as $mapel): ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <?= htmlspecialchars($mapel->nama_kelas); ?>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= htmlspecialchars($mapel->nama_mapel); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('guru/mapel/classroom/' . $mapel->id_mapel . '/' . $mapel->id_kelas); ?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Masuk Kelas</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning">
                    Tidak ada mata pelajaran yang Anda ajar di tingkat ini.
                </div>
            </div>
        <?php endif; ?>

    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
