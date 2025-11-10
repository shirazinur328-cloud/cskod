<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Mata Pelajaran & Kelas</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <?php if(empty($mapel_kelas_list)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    Anda belum memiliki mata pelajaran dan kelas yang ditugaskan.
                </div>
            </div>
        <?php else: ?>
            <?php foreach($mapel_kelas_list as $mk): ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    <?= $mk->nama_mapel ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mk->nama_kelas ?></div>
                                <div class="mt-3">
                                    <a href="<?= base_url('guru/mapel/classroom/'.$mk->id_mapel.'/'.$mk->id_kelas); ?>" 
                                       class="btn btn-primary btn-sm">Masuk Ruang Kelas</a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->