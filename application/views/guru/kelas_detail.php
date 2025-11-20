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
                    <a href="<?= base_url('guru/mapel/classroom/' . $mapel->id_mapel . '/' . $mapel->id_kelas); ?>" class="text-decoration-none" style="color: inherit;">
                        <div class="card card-kelas border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="badge badge-warning-custom text-dark text-xs font-weight-bold mb-2">
                                                <?= htmlspecialchars($mapel->nama_kelas); ?>
                                            </span>
                                            <h5 class="card-title font-weight-bold text-gray-900 mb-3">
                                                <?= htmlspecialchars($mapel->nama_mapel); ?>
                                            </h5>
                                        </div>
                                        <div class="text-right">
                                            <i class="fas fa-chalkboard-teacher fa-lg text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
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
