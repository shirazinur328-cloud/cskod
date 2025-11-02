<?php $this->load->view('templates/siswa/head'); ?>
<?php $this->load->view('templates/siswa/navbar'); ?>
<?php $this->load->view('templates/siswa/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <?php echo isset($subject) ? htmlspecialchars($subject['nama_mapel']) : 'Subject Detail'; ?>
                        </h1>
                        <a href="<?php echo base_url('index.php/murid'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Dashboard
                        </a>
                    </div>

                    <!-- Subject Detail Content -->
                    <?php if (isset($subject) && !empty($subject)): ?>
                    <div class="row">
                        <!-- Subject Information Card -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Subject Information</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Subject Name -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="subjectName"><strong>Subject Name:</strong></label>
                                                <p id="subjectName" class="form-control-static"><?php echo htmlspecialchars($subject['nama_mapel']); ?></p>
                                            </div>
                                        </div>
                                        
                                        <!-- Teacher Name -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="teacherName"><strong>Teacher:</strong></label>
                                                <p id="teacherName" class="form-control-static">
                                                    <?php echo htmlspecialchars($subject['nama_guru'] ?? 'Teacher not assigned'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Subject Description -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="subjectDescription"><strong>Description:</strong></label>
                                                <p id="subjectDescription" class="form-control-static">
                                                    <?php echo htmlspecialchars($subject['deskripsi']); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Meetings Section with Accordion -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pertemuan (Meetings)</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php if (!empty($meetings) && is_array($meetings)): ?>
                                        <div id="meetingsAccordion">
                                            <?php foreach ($meetings as $index => $meeting): ?>
                                                <div class="card mb-2">
                                                    <div class="card-header" id="heading<?php echo $meeting['id_pertemuan']; ?>">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link text-start w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseM<?php echo $meeting['id_pertemuan']; ?>" aria-expanded="false" aria-controls="collapseM<?php echo $meeting['id_pertemuan']; ?>">



                                                                <i class="fas fa-calendar-day mr-2"></i>
                                                                <?php echo htmlspecialchars($meeting['nama_pertemuan']); ?>
                                                                <small class="text-muted ml-3">
                                                                    <i class="fas fa-clock mr-1"></i>
                                                                    <?php echo date('d M Y', strtotime($meeting['tanggal'])); ?>
                                                                </small>
                                                                <i class="fas fa-chevron-down float-right"></i>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="collapseM<?php echo $meeting['id_pertemuan']; ?>" class="collapse" aria-labelledby="heading<?php echo $meeting['id_pertemuan']; ?>" data-bs-parent="#meetingsAccordion">



                                                        <div class="card-body">
                                                            <!-- Materials Section -->
                                                            <div class="mb-4">
                                                                <h6 class="font-weight-bold text-primary">
                                                                    <i class="fas fa-book mr-2"></i>Materi (Materials)
                                                                </h6>
                                                                <?php if (!empty($meeting['materials']) && is_array($meeting['materials'])): ?>
                                                                    <?php foreach ($meeting['materials'] as $material): ?>
                                                                        <div class="card mb-2">
                                                                            <div class="card-body">
                                                                                <h6 class="card-title"><?php echo htmlspecialchars($material['judul_materi']); ?></h6>
                                                                                <p class="card-text"><?php echo htmlspecialchars($material['deskripsi']); ?></p>
                                                                                <?php if (!empty($material['file_materi'])): ?>
                                                                                    <div class="mt-2">
                                                                                        <span class="badge badge-<?php echo $material['tipe_file'] === 'pdf' ? 'danger' : ($material['tipe_file'] === 'video' ? 'warning' : 'info'); ?> mr-2">
                                                                                            <?php echo strtoupper($material['tipe_file']); ?>
                                                                                        </span>
                                                                                        <a href="<?php echo base_url('uploads/materi/' . $material['file_materi']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                                            <i class="fas fa-download mr-1"></i>Download Materi
                                                                                        </a>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                                <small class="text-muted">
                                                                                    <i class="fas fa-edit mr-1"></i>Updated: <?php echo date('d M Y H:i', strtotime($material['updated_at'])); ?>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <p class="text-muted">Tidak ada materi yang tersedia untuk pertemuan ini.</p>
                                                                <?php endif; ?>
                                                            </div>

                                                            <!-- Assignments Section -->
                                                            <div>
                                                                <h6 class="font-weight-bold text-primary">
                                                                    <i class="fas fa-tasks mr-2"></i>Tugas (Assignments)
                                                                </h6>
                                                                <?php if (!empty($meeting['assignments']) && is_array($meeting['assignments'])): ?>
                                                                    <?php foreach ($meeting['assignments'] as $assignment): ?>
                                                                        <div class="card mb-2">
                                                                            <div class="card-body">
                                                                                <h6 class="card-title"><?php echo htmlspecialchars($assignment['judul_tugas']); ?></h6>
                                                                                <p class="card-text"><?php echo htmlspecialchars($assignment['deskripsi']); ?></p>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <span class="d-block">
                                                                                            <i class="fas fa-calendar-day mr-1 text-info"></i>
                                                                                            <strong>Deadline:</strong> <?php echo date('d M Y H:i', strtotime($assignment['deadline'])); ?>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="col-md-6 text-right">
                                                                                        <span class="badge badge-<?php echo $assignment['status'] === 'aktif' ? 'success' : 'secondary'; ?>">
                                                                                            <?php echo $assignment['status']; ?>
                                                                                        </span>
                                                                                        <a href="#" class="btn btn-sm btn-outline-primary ml-2 disabled" title="Tugas detail akan tersedia segera">
                                                                                            <i class="fas fa-eye mr-1"></i>Detail Tugas
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <small class="text-muted">
                                                                                    <i class="fas fa-edit mr-1"></i>Updated: <?php echo date('d M Y H:i', strtotime($assignment['updated_at'])); ?>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <p class="text-muted">Tidak ada tugas yang tersedia untuk pertemuan ini.</p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">Belum ada pertemuan yang dijadwalkan untuk mata pelajaran ini.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <p>Subject information not found or you don't have access to this subject.</p>
                                    <a href="<?php echo base_url('index.php/murid'); ?>" class="btn btn-primary">Back to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <!-- /.container-fluid -->

                <script>
                    document.addEventListener('show.bs.collapse', e => { e.target.previousElementSibling.classList.add('bg-light'); });
                    document.addEventListener('hide.bs.collapse', e => { e.target.previousElementSibling.classList.remove('bg-light'); });
                </script>


<?php $this->load->view('templates/siswa/footer'); ?>