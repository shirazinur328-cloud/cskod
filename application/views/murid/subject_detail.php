<?php $this->load->view('templates/siswa/head'); ?>
<?php $this->load->view('templates/siswa/navbar'); ?>
<?php $this->load->view('templates/siswa/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Header -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mb-0 text-gray-800"><?php echo htmlspecialchars($subject['nama_mapel']); ?></h1>
                    <p class="mb-0 text-muted">Oleh: <?php echo htmlspecialchars($subject['nama_guru']); ?></p>
                </div>
                <div>
                    <a href="javascript:history.back()" class="btn btn-secondary btn-sm shadow-sm mr-2">
                        <i class="fas fa-arrow-left fa-sm"></i> Kembali
                    </a>
                    <a href="<?= site_url('murid/dashboard/my_grades'); ?>" class="btn btn-sm btn-outline-primary shadow-sm">
                        <i class="fas fa-star fa-sm text-primary-50"></i> Lihat Nilai Saya
                    </a>
                </div>
            </div>
            <hr>
            <h6 class="font-weight-bold text-primary mb-2">Total Progres Belajar</h6>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $overall_progress; ?>%" aria-valuenow="<?php echo $overall_progress; ?>" aria-valuemin="0" aria-valuemax="100">
                    <b><?php echo $overall_progress; ?>%</b>
                </div>
            </div>
        </div>
    </div>

    <!-- Accordion for Meetings -->
    <div class="accordion" id="accordionPertemuan">
        <?php if (!empty($meetings)) : ?>
            <?php foreach ($meetings as $index => $meeting) : ?>
                <div class="card shadow mb-2">
                    <div class="card-header" id="heading-<?php echo $meeting['id_pertemuan']; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-pertemuan btn-block text-left d-flex justify-content-between align-items-center" type="button" data-id="<?php echo $meeting['id_pertemuan']; ?>" data-toggle="collapse" data-target="#collapse-<?php echo $meeting['id_pertemuan']; ?>" aria-expanded="<?php echo $index == 0 ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $meeting['id_pertemuan']; ?>">
                                <span class="font-weight-bold text-primary">Pertemuan <?php echo $index + 1; ?>: <?php echo htmlspecialchars($meeting['nama_pertemuan']); ?></span>
                                <?php if ($meeting['status'] == 'Selesai') : ?>
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Selesai</span>
                                <?php else : ?>
                                    <span class="badge badge-warning"><i class="fas fa-hourglass-half"></i> Belum Dikerjakan</span>
                                <?php endif; ?>
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

