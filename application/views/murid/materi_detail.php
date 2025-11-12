

<?php
// This view can be loaded for a single materi or for a "pertemuan" which might have multiple materi.
// We determine if we have a single materi object or an array of them.
$materials = [];
if (isset($materi[0]) && is_array($materi[0])) {
    // This is an array of materi objects, likely from detail_pertemuan
    $materials = $materi;
} elseif (!empty($materi)) {
    // This is a single materi object, likely from materi_detail
    $materials[] = $materi;
}

// Similarly, prepare tasks if they exist
$tasks = [];
if (isset($tugas[0]) && is_array($tugas[0])) {
    $tasks = $tugas;
} elseif (!empty($tugas)) {
    $tasks[] = $tugas;
}
?>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Isi Materi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
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
                    <p>Belum ada materi untuk pertemuan ini.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tugas</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="tugas-content">
                    <?php if (!empty($tugas)) : ?>
                        <?php foreach ($tugas as $t) : ?>
                            <div class="tugas-item mb-3">
                                <h6 class="font-weight-bold"><?php echo htmlspecialchars($t['judul_tugas']); ?></h6>
                                <p><?php echo nl2br(htmlspecialchars($t['deskripsi'])); ?></p>
                                <?php if (!empty($t['deadline'])) : ?>
                                    <small class="text-muted">Deadline: <?php echo date('d F Y, H:i', strtotime($t['deadline'])); ?></small>
                                    <br>
                                <?php endif; ?>
                                <a href="<?php echo site_url('murid/tugas/kerjakan/' . $t['id_tugas']); ?>" class="btn btn-sm btn-primary mt-2">Kerjakan Tugas</a>
                                <div class="mt-2">
                                    <small class="text-muted">Status: <b><?php echo htmlspecialchars($t['submission_status']); ?></b></small><br>
                                    <small class="text-muted">Nilai: <b><?php echo htmlspecialchars($t['grade']); ?></b></small><br>
                                    <?php if (!empty($t['komentar_guru'])) : ?>
                                        <small class="text-muted">Komentar Guru: <?php echo nl2br(htmlspecialchars($t['komentar_guru'])); ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (count($tugas) > 1) echo '<hr>'; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Tidak ada tugas untuk pertemuan ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.mark-complete-btn').on('click', function() {
        var button = $(this);
        var id_materi = button.data('id_materi');
        var messageContainer = button.next('.mark-complete-message'); // Get the message container next to the button

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
                    // Optionally, refresh the progress bar in the parent subject_detail view
                    // This would require a more complex event or a full page reload
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
