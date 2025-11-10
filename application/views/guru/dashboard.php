<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Mapel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Mata Pelajaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_mapel ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Dashboard Guru</h6>
                </div>
                <div class="card-body">
                    <p>Gunakan menu navigasi di samping untuk mengelola mata pelajaran dan kelas yang Anda ajar.</p>
                    <p>Untuk mulai mengajar, klik menu "Mapel & Kelas" untuk memilih kelas yang akan diajar.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->