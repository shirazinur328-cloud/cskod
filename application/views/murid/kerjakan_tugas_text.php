<?php $this->load->view('templates/siswa/head', ['title' => 'Kerjakan Tugas']); ?>



        <?php $this->load->view('templates/siswa/navbar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('templates/siswa/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Kerjakan Tugas: <?= htmlspecialchars($tugas['judul_tugas']); ?></h1>

                    <div class="row">
                        <!-- Left Column: Task Details -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Tugas</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Deskripsi:</strong></p>
                                    <p><?= nl2br(htmlspecialchars($tugas['deskripsi'])); ?></p>
                                    <hr>
                                    <p><strong>Deadline:</strong> <?= date('d F Y, H:i', strtotime($tugas['deadline'])); ?></p>
                                    <?php if (!empty($submission)): ?>
                                        <p><strong>Status Tugas Anda:</strong> 
                                            <?php
                                                $badge_class = 'badge-secondary';
                                                if ($submission['status'] == 'Selesai') {
                                                    $badge_class = 'badge-success';
                                                } elseif ($submission['status'] == 'Revisi') {
                                                    $badge_class = 'badge-warning';
                                                } elseif ($submission['status'] == 'Dinilai') {
                                                    $badge_class = 'badge-primary';
                                                }
                                            ?>
                                            <span class="badge <?= $badge_class; ?>"><?= htmlspecialchars($submission['status']); ?></span>
                                        </p>
                                        <?php if (!empty($submission['komentar_guru'])): ?>
                                            <p><strong>Komentar Guru:</strong> <?= nl2br(htmlspecialchars($submission['komentar_guru'])); ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Submission Form -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Form Jawaban</h6>
                                </div>
                                <div class="card-body">
                                    <?php echo form_open('murid/tugas/submit_text'); ?>
                                        <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas']; ?>">
                                        
                                        <div class="form-group">
                                            <label for="jawaban_teks">Jawaban Anda</label>
                                            <textarea class="form-control" id="jawaban_teks" name="jawaban_teks" rows="10" required><?= htmlspecialchars($submission['kode_jawaban'] ?? ''); ?></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Kumpulkan Jawaban</button>
                                        <a href="<?= base_url('murid/dashboard/subject_detail/' . $tugas['id_mapel']); ?>" class="btn btn-secondary">Batal</a>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php $this->load->view('templates/siswa/footer'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>
