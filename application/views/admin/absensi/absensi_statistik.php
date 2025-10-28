<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-dark font-weight-bold">Statistik Absensi Guru</h1>

    <?php if($this->session->flashdata('gagal')): ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('gagal'); ?>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Statistik Bulan: <?= date('F', mktime(0, 0, 0, $bulan, 10)) . ' ' . $tahun; ?></h6>
        </div>
        <div class="card-body">
            
            <!-- Month/Year Picker -->
            <form action="<?= site_url('admin/absensi/statistik'); ?>" method="get" class="form-inline mb-4">
                <div class="form-group">
                    <label for="bulan" class="mr-2">Pilih Bulan:</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i; ?>" <?= ($i == $bulan) ? 'selected' : ''; ?>><?= date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group ml-2">
                    <label for="tahun" class="mr-2">Tahun:</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" value="<?= $tahun; ?>" min="2020" max="<?= date('Y'); ?>">
                </div>
                <button type="submit" class="btn btn-primary ml-2">Tampilkan</button>
                <a href="<?= site_url('admin/absensi/export_laporan/' . $bulan . '/' . $tahun); ?>" class="btn btn-success ml-auto">
                    <i class="fas fa-file-csv"></i> Export Laporan (CSV)
                </a>
            </form>

            <hr>

            <!-- Statistics Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-left">Nama Guru</th>
                            <th class="bg-success">Hadir</th>
                            <th class="bg-warning">Sakit</th>
                            <th class="bg-info">Izin</th>
                            <th class="bg-danger">Alpa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftar_guru as $guru): ?>
                            <?php 
                                $stats = isset($statistik[$guru->id_guru]) ? $statistik[$guru->id_guru] : null;
                                $hadir = $stats ? $stats->hadir : 0;
                                $sakit = $stats ? $stats->sakit : 0;
                                $izin = $stats ? $stats->izin : 0;
                                $alpa = $stats ? $stats->alpa : 0;
                            ?>
                            <tr>
                                <td class="text-left"><?= $guru->nama_guru; ?></td>
                                <td><?= $hadir; ?></td>
                                <td><?= $sakit; ?></td>
                                <td><?= $izin; ?></td>
                                <td><?= $alpa; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
