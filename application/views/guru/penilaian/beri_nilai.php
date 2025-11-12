<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= htmlspecialchars($title); ?></h1>
        <a href="javascript:history.back()" class="btn btn-secondary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Tugas</h6>
                </div>
                <div class="card-body">
                    <p><strong>Tugas:</strong> <?= htmlspecialchars($jawaban->judul_tugas); ?></p>
                    <p><strong>Untuk Murid:</strong> <?= htmlspecialchars($jawaban->nama_murid); ?></p>
                    <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($jawaban->deskripsi)); ?></p>
                    <p><strong>Waktu Submit:</strong> <?= date('d M Y, H:i', strtotime($jawaban->submitted_at)); ?></p>
                    <p><strong>Status:</strong> <span class="badge badge-info"><?= htmlspecialchars($jawaban->status); ?></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Grading Form -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Penilaian</h6>
                </div>
                <div class="card-body">
                    <?php echo form_open('guru/penilaian/simpan_nilai'); ?>
                        <input type="hidden" name="id_tugas_murid" value="<?= $jawaban->id_tugas_murid; ?>">
                        <input type="hidden" name="id_tugas" value="<?= $jawaban->id_tugas; ?>">

                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" value="<?= htmlspecialchars($jawaban->nilai ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="komentar_guru">Komentar Guru</label>
                            <textarea name="komentar_guru" id="komentar_guru" class="form-control" rows="3"><?= htmlspecialchars($jawaban->komentar_guru ?? ''); ?></textarea>
                        </div>

                        <button type="submit" name="submit_action" value="selesai" class="btn btn-success">
                            <i class="fas fa-check"></i> Selesai Dinilai
                        </button>
                        <button type="submit" name="submit_action" value="revisi" class="btn btn-warning">
                            <i class="fas fa-redo"></i> Revisi
                        </button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Student Answer Display -->
        <div class="col-lg-<?= ($jawaban->tipe_tugas == 'file') ? '12' : '6'; ?>">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jawaban Murid</h6>
                </div>
                <div class="card-body">
                    <?php if ($jawaban->tipe_tugas == 'file'): ?>
                        <?php if (!empty($jawaban->file_jawaban)): ?>
                            <?php
                                $file_path = base_url('uploads/tugas_murid/' . $jawaban->file_jawaban);
                                $file_ext = pathinfo($jawaban->file_jawaban, PATHINFO_EXTENSION);
                            ?>
                            <?php if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <img src="<?= $file_path; ?>" class="img-fluid mb-3" alt="Jawaban File">
                            <?php elseif ($file_ext == 'pdf'): ?>
                                <div class="embed-responsive embed-responsive-16by9 mb-3" style="height: 800px;"> <!-- Increased height for PDF -->
                                    <iframe class="embed-responsive-item" src="<?= $file_path; ?>"></iframe>
                                </div>
                            <?php else: ?>
                                <p>File tidak dapat ditampilkan di browser. Silakan unduh.</p>
                            <?php endif; ?>
                            <a href="<?= $file_path; ?>" class="btn btn-info btn-sm" target="_blank">
                                <i class="fas fa-download"></i> Unduh File
                            </a>
                        <?php else: ?>
                            <p>Murid belum mengupload file jawaban.</p>
                        <?php endif; ?>
                    <?php elseif ($jawaban->tipe_tugas == 'coding' || $jawaban->tipe_tugas == 'text'): ?>
                        <?php if (!empty($jawaban->kode_jawaban)): ?>
                            <h6 class="font-weight-bold">Kode/Teks Jawaban:</h6>
                            <pre><code id="student-code" class="language-<?= htmlspecialchars($jawaban->bahasa ?? 'plaintext'); ?>"><?= htmlspecialchars($jawaban->kode_jawaban); ?></code></pre>
                            <?php if ($jawaban->tipe_tugas == 'coding' && in_array($jawaban->bahasa, ['html', 'css', 'javascript'])): ?>
                                <button type="button" id="show-output-btn" class="btn btn-info btn-sm mt-2">
                                    <i class="fas fa-play"></i> Tampilkan Output
                                </button>
                            <?php endif; ?>
                            <h6 class="font-weight-bold mt-4">Hasil Output:</h6>
                            <div id="output-container" class="alert alert-info border" role="alert">
                                <?php if ($jawaban->tipe_tugas == 'coding' && in_array($jawaban->bahasa, ['html', 'css', 'javascript'])): ?>
                                    Klik "Tampilkan Output" untuk melihat hasil eksekusi kode di browser.
                                <?php else: ?>
                                    Output kode tidak dieksekusi secara otomatis di server. Harap verifikasi output secara manual atau gunakan alat eksternal.
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <p>Murid belum memasukkan kode/teks jawaban.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Tipe tugas tidak dikenal.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showOutputBtn = document.getElementById('show-output-btn');
    const outputContainer = document.getElementById('output-container');
    const studentCodeElement = document.getElementById('student-code');

    if (showOutputBtn && outputContainer && studentCodeElement) {
        showOutputBtn.addEventListener('click', function() {
            const code = studentCodeElement.textContent;
            const language = "<?= htmlspecialchars($jawaban->bahasa ?? ''); ?>";
            outputContainer.innerHTML = ''; // Clear previous output

            if (language === 'html') {
                const iframe = document.createElement('iframe');
                iframe.style.width = '100%';
                iframe.style.height = '300px';
                iframe.style.border = 'none';
                outputContainer.appendChild(iframe);
                iframe.contentWindow.document.open();
                iframe.contentWindow.document.write(code);
                iframe.contentWindow.document.close();
            } else if (language === 'css') {
                const iframe = document.createElement('iframe');
                iframe.style.width = '100%';
                iframe.style.height = '300px';
                iframe.style.border = 'none';
                const sampleHtml = `
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>${code}</style>
                    </head>
                    <body>
                        <h1>Contoh Judul</h1>
                        <p>Ini adalah contoh paragraf yang akan dipengaruhi oleh kode CSS Anda.</p>
                        <button>Tombol Contoh</button>
                    </body>
                    </html>
                `;
                outputContainer.appendChild(iframe);
                iframe.contentWindow.document.open();
                iframe.contentWindow.document.write(sampleHtml);
                iframe.contentWindow.document.close();
            } else if (language === 'javascript') {
                let outputLog = [];
                const originalConsoleLog = console.log;
                console.log = function(...args) {
                    outputLog.push(args.map(arg => JSON.stringify(arg)).join(' '));
                };

                try {
                    new Function(code)();
                    outputContainer.innerHTML = `<pre>${outputLog.join('\\n') || 'Tidak ada output console.'}</pre>`;
                } catch (e) {
                    outputContainer.innerHTML = `<pre style="color: red;">Error: ${e.message}</pre>`;
                } finally {
                    console.log = originalConsoleLog; // Restore original console.log
                }
            } else {
                outputContainer.innerHTML = '<div class="alert alert-warning" role="alert">Pratinjau output hanya tersedia untuk HTML, CSS, dan JavaScript.</div>';
            }
        });
    }
});
</script>
