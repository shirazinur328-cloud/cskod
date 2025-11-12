<?php $this->load->view('templates/siswa/head', ['title' => 'Kerjakan Tugas Coding']); ?>

<!-- CodeMirror CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/show-hint.min.css">

<style>
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
        font-size: 14px;
    }
    #output-container {
        margin-top: 20px;
        background-color: #F3F4F6; /* Requested light gray background */
        color: #333333; /* Dark text for readability */
        padding: 15px;
        border-radius: 5px;
        font-family: 'Courier New', Courier, monospace;
        white-space: pre-wrap;
        min-height: 50px;
        overflow: auto; /* Add scroll for long content */
        border: 1px solid #dddddd; /* Thin border */
    }
    #output-container pre {
        margin: 0; /* Remove default margin from pre tag */
        padding: 0; /* Remove padding inside pre itself, let container handle it */
    }
    .output-title {
        font-weight: normal; /* Not bold as per user's request for "normal" */
        color: #666666; /* Less prominent color for the title */
        margin-bottom: 10px;
    }
</style>

<body id="page-top">
    <div id="wrapper">
        <?php $this->load->view('templates/siswa/navbar'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php $this->load->view('templates/siswa/topbar'); ?>

                                <div class="container-fluid">

                                    <h1 class="h3 mb-4 text-gray-800">Kerjakan Tugas: <?= html_escape($tugas['judul_tugas']); ?></h1>

                                    <div class="row">
                                        <!-- Left Column: Task Description and Expected Output -->
                                        <div class="col-lg-6">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Deskripsi Tugas</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p><?= nl2br(html_escape($tugas['deskripsi'])); ?></p>
                                                    <?php if (!empty($submission)): ?>
                                                        <hr>
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
                                                            <span class="badge <?= $badge_class; ?>"><?= html_escape($submission['status']); ?></span>
                                                        </p>
                                                        <?php if (!empty($submission['komentar_guru'])): ?>
                                                            <p><strong>Komentar Guru:</strong> <?= nl2br(html_escape($submission['komentar_guru'])); ?></p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <?php if (!empty($tugas['expected_output'])) : ?>
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-info">Output yang Diharapkan</h6>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <pre><code><?= html_escape($tugas['expected_output']); ?></code></pre>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Right Column: Code Editor and Output -->
                                        <div class="col-lg-6">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Editor Kode (Tekan Ctrl+Space untuk saran)</h6>
                                                </div>
                                                <div class="card-body">
                                                    <form id="form-coding" action="<?= site_url('murid/tugas/submit_coding'); ?>" method="POST">
                                                        <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas']; ?>">
                                                        <textarea id="code-editor" name="kode_jawaban"><?= html_escape($submission['kode_jawaban'] ?? ''); ?></textarea>
                                                        <div class="mt-3">
                                                            <button type="button" id="run-btn" class="btn btn-primary">
                                                                <i class="fas fa-play"></i> Tampilkan Output
                                                            </button>
                                                            <button type="button" id="reset-btn" class="btn btn-warning-custom">
                                                                <i class="fas fa-sync-alt"></i> Reset Code
                                                            </button>
                                                            <button type="submit" class="btn btn-secondary">
                                                                <i class="fas fa-paper-plane"></i> Kirim Tugas
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Output</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div id="output-container">
                                                        <!-- Output will be displayed here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.container-fluid -->


