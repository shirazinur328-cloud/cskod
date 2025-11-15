<?php
// This view can be loaded for a single materi or for a "pertemuan" which might have multiple materi.
// We determine if we have a single materi object or an array of them.
$materials = [];
if (isset($materi) && !empty($materi)) {
    $materials = is_array(reset($materi)) ? $materi : [$materi];
}

// Similarly, prepare tasks if they exist
$tasks = [];
if (isset($tugas) && !empty($tugas)) {
    $tasks = is_array(reset($tugas)) ? $tugas : [$tugas];
}
?>

<div class="card-body" style="padding: 1.5rem;">
    <!-- Nav Tabs -->
    <ul class="nav nav-tabs mb-4" id="pertemuanTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="materi-tab" data-toggle="tab" href="#materi-content" role="tab" aria-controls="materi-content" aria-selected="true">
                <i class="fas fa-book-reader mr-2"></i>Materi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tugas-tab" data-toggle="tab" href="#tugas-content" role="tab" aria-controls="tugas-content" aria-selected="false">
                <i class="fas fa-pencil-alt mr-2"></i>Tugas
                <?php if (count($tasks) > 0): ?>
                    <span class="badge badge-primary ml-2"><?= count($tasks) ?></span>
                <?php endif; ?>
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="pertemuanTabContent">
        <!-- Materi Tab Pane -->
        <div class="tab-pane fade show active" id="materi-content" role="tabpanel" aria-labelledby="materi-tab">
            <?php if (!empty($materials)) : ?>
                <?php foreach ($materials as $m) : ?>
                    <div class="materi-item mb-4">
                        <h5 class="font-weight-bold"><?php echo htmlspecialchars($m['judul_materi']); ?></h5>
                        <p><?php echo nl2br(htmlspecialchars($m['deskripsi'])); ?></p>
                        <?php if (!empty($m['file_materi'])) : ?>
                            <?php
                                $file_path = $m['file_materi'];
                                $is_youtube = (strpos($file_path, 'youtube.com') !== false || strpos($file_path, 'youtu.be') !== false);
                                $is_pdf = pathinfo($file_path, PATHINFO_EXTENSION) == 'pdf' || strpos($file_path, '.pdf') !== false;
                                $is_external_url = (strpos($file_path, 'http') === 0 || strpos($file_path, 'https') === 0);

                                if ($is_youtube) {
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $file_path, $match);
                                    $youtube_id = $match[1] ?? '';
                                    if ($youtube_id) {
                                        echo '<div class="embed-responsive embed-responsive-16by9 mb-3"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . htmlspecialchars($youtube_id) . '" allowfullscreen></iframe></div>';
                                    }
                                } elseif ($is_pdf) {
                                    $pdf_url = $is_external_url ? $file_path : base_url('uploads/materi/' . $file_path);
                                    echo '<div class="embed-responsive embed-responsive-16by9 mb-3" style="height: 500px;"><iframe class="embed-responsive-item" src="' . htmlspecialchars($pdf_url) . '"></iframe></div>';
                                    echo '<a href="' . htmlspecialchars($pdf_url) . '" class="btn btn-sm btn-success btn-icon-split" target="_blank"><span class="icon text-white-50"><i class="fas fa-download"></i></span><span class="text">Unduh File PDF</span></a>';
                                } else {
                                    $download_url = $is_external_url ? $file_path : base_url('uploads/materi/' . $file_path);
                                    echo '<a href="' . htmlspecialchars($download_url) . '" class="btn btn-sm btn-success btn-icon-split" target="_blank"><span class="icon text-white-50"><i class="fas fa-download"></i></span><span class="text">Unduh File: ' . htmlspecialchars(basename($file_path)) . '</span></a>';
                                }
                            ?>
                        <?php endif; ?>
                        <div class="mt-3">
                            <?php
                                $is_completed = $this->Model_materi->is_material_completed($m['id_materi'], 2); // Hardcoded student ID
                                $button_class = $is_completed ? 'btn-success' : 'btn-primary';
                                $button_text = $is_completed ? '<i class="fas fa-check-circle"></i> Selesai' : '<i class="fas fa-check-circle"></i> Tandai Selesai';
                            ?>
                            <button class="btn <?= $button_class; ?> mark-complete-btn" data-id_materi="<?= $m['id_materi']; ?>" <?= empty($m['id_materi']) ? 'disabled' : ''; ?>>
                                <?= $button_text; ?>
                            </button>
                            <small class="form-text text-danger mt-2 mark-complete-message"></small>
                        </div>
                    </div>
                    <?php if (count($materials) > 1) echo '<hr>'; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-muted mt-3">Belum ada materi untuk pertemuan ini.</p>
            <?php endif; ?>
        </div>

        <!-- Tugas Tab Pane -->
        <div class="tab-pane fade" id="tugas-content" role="tabpanel" aria-labelledby="tugas-tab">
            <div class="tugas-content">
                <?php if (!empty($tasks)) : ?>
                    <?php foreach ($tasks as $t) : ?>
                        <div class="tugas-item mb-3">
                            <h6 class="font-weight-bold"><?php echo htmlspecialchars($t['judul_tugas']); ?></h6>
                            <p><?php echo nl2br(htmlspecialchars($t['deskripsi'])); ?></p>
                            <?php if (!empty($t['deadline'])) : ?>
                                <small class="text-muted">Deadline: <?php echo date('d F Y, H:i', strtotime($t['deadline'])); ?></small>
                                <br>
                            <?php endif; ?>
                            <?php
                                $task_type = !empty($t['tipe_tugas']) ? $t['tipe_tugas'] : 'file';
                                $kerjakan_url = site_url('murid/tugas/kerjakan/' . $task_type . '/' . $t['id_tugas']);
                            ?>
                            <?php if ($t['submission_status'] !== 'Terkirim' && $t['submission_status'] !== 'Dinilai') : ?>
                                <a href="<?php echo $kerjakan_url; ?>" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-pencil-alt fa-sm"></i> Kerjakan Tugas
                                </a>
                            <?php endif; ?>
                            <div class="mt-2">
                                <small class="text-muted">Status: <b><?php echo htmlspecialchars($t['submission_status']); ?></b></small><br>
                                <small class="text-muted">Nilai: <b><?php echo htmlspecialchars($t['grade'] ?? 'Belum dinilai'); ?></b></small><br>
                                <?php if (!empty($t['komentar_guru'])) : ?>
                                    <small class="text-muted">Komentar Guru: <?php echo nl2br(htmlspecialchars($t['komentar_guru'])); ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (count($tasks) > 1) echo '<hr>'; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center text-muted mt-3">Tidak ada tugas untuk pertemuan ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.mark-complete-btn').on('click', function() {
        var button = $(this);
        var id_materi = button.data('id_materi');
        var messageContainer = button.next('.mark-complete-message');

        if (!id_materi) {
            messageContainer.text('Tidak ada materi untuk ditandai selesai.').removeClass('text-success').addClass('text-danger');
            return;
        }

        button.prop('disabled', true).text('Memproses...');

        $.ajax({
            url: '<?= site_url('murid/dashboard/mark_materi_complete'); ?>',
            method: 'POST',
            data: { id_materi: id_materi },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    button.removeClass('btn-primary').addClass('btn-success').html('<i class="fas fa-check-circle"></i> Selesai');
                    messageContainer.text(response.message).removeClass('text-danger').addClass('text-success');
                    location.reload(); 
                } else {
                    button.prop('disabled', false).text('Tandai Selesai');
                    messageContainer.text(response.message).removeClass('text-success').addClass('text-danger');
                }
            },
            error: function() {
                button.prop('disabled', false).text('Tandai Selesai');
                messageContainer.text('Terjadi kesalahan saat memproses permintaan.').removeClass('text-success').addClass('text-danger');
            }
        });
    });
});
</script>
