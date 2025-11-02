<?php $this->load->view('templates/siswa/head'); ?>
<?php $this->load->view('templates/siswa/navbar'); ?>
<?php $this->load->view('templates/siswa/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Murid - CSKod</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Subject Cards -->
                    <div class="row">
                        <?php if (!empty($mapel) && is_array($mapel)): ?>
                        <?php foreach ($mapel as $mapel_item): ?>
                        <!-- Subject Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?php echo base_url('index.php/murid/dashboard/subject_detail/' . $mapel_item['id_mapel']); ?>" class="text-decoration-none">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h4 font-weight-bold text-primary text-uppercase mb-1">
                                                    <?php echo htmlspecialchars($mapel_item['nama_mapel']); ?></div>
                                                <div class="mb-0 font-weight-bold text-gray-800" style="font-size: 1rem;">Guru: <?php echo htmlspecialchars($mapel_item['nama_guru'] ?? 'Belum ada guru'); ?></div>
                                                <div class="mt-2">
                                                    <div class="text-xs text-gray-500">
                                                        <?php echo htmlspecialchars(substr($mapel_item['deskripsi'], 0, 60)); ?><?php echo strlen($mapel_item['deskripsi']) > 60 ? '...' : ''; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-book fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <p>Tidak ada mata pelajaran yang tersedia.</p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php $this->load->view('templates/siswa/footer'); ?>