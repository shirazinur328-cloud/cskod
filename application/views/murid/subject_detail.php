<?php $this->load->view('templates/siswa/head'); ?>
<?php $this->load->view('templates/siswa/navbar'); ?>
<?php $this->load->view('templates/siswa/topbar'); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-book-open text-primary mr-2"></i><?php echo htmlspecialchars($subject['nama_mapel']); ?>
        </h1>
        <div>
            <a href="javascript:history.back()" class="btn btn-secondary btn-sm shadow-sm mr-2">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
            <a href="<?= site_url('murid/dashboard/my_grades'); ?>" class="btn btn-sm btn-outline-primary shadow-sm">
                <i class="fas fa-star fa-sm text-primary-50"></i> Lihat Nilai Saya
            </a>
        </div>
    </div>

    <!-- Subject Info Card -->
    <div class="card shadow mb-4 subject-info-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="mb-2 text-muted">Guru: <span class="font-weight-bold"><?php echo htmlspecialchars($subject['nama_guru']); ?></span></p>
                    <hr>
                    <h6 class="font-weight-bold text-primary mb-2">Total Progres Belajar</h6>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-animated-gradient" role="progressbar" style="width: <?php echo $progress_details['percentage']; ?>%" aria-valuenow="<?php echo $progress_details['percentage']; ?>" aria-valuemin="0" aria-valuemax="100">
                            <b><?php echo $progress_details['percentage']; ?>%</b>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center mt-3 mt-lg-0">
                    <div class="display-4 font-weight-bold"><?php echo $progress_details['completed_materi']; ?>/<?php echo $progress_details['total_materi']; ?></div>
                    <span class="text-muted">Materi Selesai</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Accordion for Meetings -->
    <div class="accordion custom-accordion" id="accordionPertemuan">
        <?php if (!empty($meetings)) : ?>
            <?php foreach ($meetings as $index => $meeting) : ?>
                <div class="card shadow mb-2 custom-accordion-item">
                    <div class="card-header custom-accordion-header" id="heading-<?php echo $meeting['id_pertemuan']; ?>">
                        <h2 class="mb-0 container-fluid">
                            <button class="btn btn-link btn-pertemuan btn-block d-flex justify-content-between align-items-center collapsed" type="button" data-id="<?php echo $meeting['id_pertemuan']; ?>" data-toggle="collapse" data-target="#collapse-<?php echo $meeting['id_pertemuan']; ?>" aria-expanded="<?php echo $index == 0 ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $meeting['id_pertemuan']; ?>">
                                <span class="font-weight-bold text-primary">Pertemuan <?php echo $index + 1; ?>: <?php echo htmlspecialchars($meeting['nama_pertemuan']); ?></span>
                                <div class="d-flex align-items-center">
                                    <?php if ($meeting['status'] == 'Selesai') : ?>
                                        <span class="badge badge-success mr-2"><i class="fas fa-check-circle"></i> Selesai</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning mr-2"><i class="fas fa-hourglass-half"></i> Belum Dikerjakan</span>
                                    <?php endif; ?>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse-<?php echo $meeting['id_pertemuan']; ?>" class="collapse <?php echo $index == 0 ? 'show' : ''; ?>" aria-labelledby="heading-<?php echo $meeting['id_pertemuan']; ?>" data-parent="#accordionPertemuan">
                        <div class="card-body pertemuan" >
                            
                       

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="card shadow">
                <div class="card-body text-center">
                    <p>Belum ada pertemuan untuk mata pelajaran ini.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/siswa/footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click", ".btn-pertemuan", function() {
            var id_pertemuan = $(this).data('id');
            var targetCollapseId = $(this).attr('data-target'); // Get the ID of the target collapse element
            var container = $(targetCollapseId).find('.pertemuan'); // Find the .pertemuan div within that specific collapse element

            // Check if content is already loaded to prevent unnecessary AJAX calls
            if (container.html().trim() === '') {
                container.html('<p class="text-center my-3">Memuat materi dan tugas...</p>'); // Show loading message
                $.ajax({
                    url:'<?= site_url('murid/dashboard/detail_pertemuan/') ?>'+id_pertemuan,
                })
                .done(function(respon){
                    container.html(respon);
                })
                .fail(function(){
                    container.html('<p class="text-danger text-center my-3">Error: Gagal memuat materi dan tugas.</p>');
                })
            }
        });
    });
</script>

