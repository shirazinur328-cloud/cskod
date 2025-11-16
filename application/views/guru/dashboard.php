<!-- Begin Page Content -->
<div class="container-fluid" style="background-color: #F8FAFC;">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #1E293B;">Dashboard</h1>
    </div>

    <!-- Content Row: Statistic Cards -->
    <div class="row">

        <!-- Card: Jumlah Kelas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-statistic h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #64748B;">Jumlah Kelas</div>
                            <div class="h5 mb-0 font-weight-bold" style="color: #1E293B;"><?= $jumlah_kelas ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Jumlah Mapel -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-statistic h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #64748B;">Mata Pelajaran</div>
                            <div class="h5 mb-0 font-weight-bold" style="color: #1E293B;"><?= $jumlah_mapel ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Tugas Belum Dinilai -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-statistic h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #64748B;">Tugas Belum Dinilai</div>
                            <div class="h5 mb-0 font-weight-bold" style="color: #1E293B;"><?= $tugas_belum_dinilai ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pencil-ruler fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Jadwal Hari Ini -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-statistic h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #64748B;">Jadwal Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold" style="color: #1E293B;"><?= $jumlah_jadwal_hari_ini ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row: Main Content -->
    <div class="row">

        <!-- Left Column: Jadwal & Progres -->
        <div class="col-lg-7">

            <!-- Jadwal Mengajar Hari Ini -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: #1E293B;">Jadwal Mengajar Hari Ini</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($jadwal_hari_ini)): ?>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <?php foreach ($jadwal_hari_ini as $jadwal): ?>
                                        <tr>
                                            <td class="align-middle"><span class="badge" style="background-color: #E0F2FE; color: #0EA5E9;"><?= date('H:i', strtotime($jadwal->waktu_mulai)) ?></span></td>
                                            <td class="align-middle">
                                                <div class="font-weight-bold" style="color: #1E293B;"><?= $jadwal->judul_pertemuan ?></div>
                                                <div class="small" style="color: #64748B;"><?= $jadwal->nama_mapel ?> - <?= $jadwal->nama_kelas ?></div>
                                            </td>
                                            <td class="text-right align-middle">
                                                <a href="<?= base_url('guru/pertemuan/masuk_kelas/' . $jadwal->id_pertemuan) ?>" class="btn btn-primary btn-sm">Masuk Kelas</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center" style="color: #64748B;">Tidak ada jadwal mengajar hari ini.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Progres Siswa per Kelas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: #1E293B;">Progres Siswa per Kelas</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($progres_siswa)): ?>
                        <?php foreach ($progres_siswa as $progres): ?>
                            <h4 class="small font-weight-bold"><?= $progres->nama_kelas ?> <span class="float-right"><?= $progres->progress ?>%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: <?= $progres->progress ?>%; background-color: #0EA5E9;" aria-valuenow="<?= $progres->progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center" style="color: #64748B;">Data progres siswa belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Right Column: Tugas Belum Dinilai -->
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: #1E293B;">Tugas Belum Dinilai</h6>
                    <a href="<?= base_url('guru/penilaian') ?>" class="btn btn-sm btn-secondary-outline">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($list_tugas_belum_dinilai)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($list_tugas_belum_dinilai as $tugas): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="font-weight-bold" style="color: #1E293B;"><?= $tugas->judul_tugas ?></div>
                                        <div class="small" style="color: #64748B;"><?= $tugas->nama_murid ?> - <?= $tugas->nama_kelas ?></div>
                                    </div>
                                    <a href="<?= base_url('guru/penilaian/beri_nilai/' . $tugas->id_tugas_murid) ?>" class="btn btn-sm" style="background-color: #F97316; color: white;">Nilai</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-center" style="color: #64748B;">Semua tugas sudah dinilai. Kerja bagus!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->