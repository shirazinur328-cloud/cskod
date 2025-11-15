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

                                        <!-- Right Column: Code Editor -->
                                        <div class="col-lg-6">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Editor Kode (Tekan Ctrl+Space untuk saran)</h6>
                                                </div>
                                                <div class="card-body">
                                                    <form id="form-coding" action="<?= site_url('murid/tugas/submit_coding'); ?>" method="POST">
                                                        <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas']; ?>">
                                                        <input type="hidden" name="id_mapel" value="<?= $tugas['id_mapel']; ?>">
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
                                        </div>
                                    </div>

                                </div>
                                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php $this->load->view('templates/siswa/footer'); ?>


</body>

</html>

        <!-- CodeMirror JS -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/show-hint.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/javascript-hint.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/xml-hint.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/html-hint.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/css-hint.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js"></script>
    
    <script>
        // Get language from PHP
        var language = "<?= !empty($tugas['bahasa']) ? strtolower($tugas['bahasa']) : 'javascript'; ?>";

        // Map language to CodeMirror mode and file
        var langMap = {
            'javascript': { mode: 'javascript', file: 'javascript/javascript.min.js' },
            'php': { mode: 'php', file: 'php/php.min.js' },
            'python': { mode: 'python', file: 'python/python.min.js' },
            'java': { mode: 'text/x-java', file: 'clike/clike.min.js' },
            'c': { mode: 'text/x-csrc', file: 'clike/clike.min.js' },
            'cpp': { mode: 'text/x-c++src', file: 'clike/clike.min.js' },
            'csharp': { mode: 'text/x-csharp', file: 'clike/clike.min.js' },
            'html': { mode: 'htmlmixed', file: 'htmlmixed/htmlmixed.min.js' },
            'css': { mode: 'css', file: 'css/css.min.js' }
        };

        var selectedLang = langMap[language] || langMap['javascript'];

        // Function to initialize the editor
        function initEditor() {
            var textarea = document.getElementById("code-editor");
            // Capture initial content from textarea BEFORE CodeMirror transforms it
            var initialCodeContent = textarea.value; 

            var editor = CodeMirror.fromTextArea(textarea, {
                lineNumbers: true,
                mode: selectedLang.mode,
                theme: "dracula", // Reverted to dracula dark theme
                indentUnit: 4,
                extraKeys: {"Ctrl-Space": "autocomplete"},
                hintOptions: { completeSingle: false }
            });
            editor.setSize("100%", 400);

            document.getElementById('reset-btn').addEventListener('click', function() {
                editor.setValue(initialCodeContent); // Use the captured initial content
            });

            document.getElementById('run-btn').addEventListener('click', function() {
                var code = editor.getValue();
                var outputContainer = document.getElementById('output-container');
                outputContainer.innerHTML = ''; // Clear previous output

                if (language === 'html') {
                    // For HTML, wrap in a basic boilerplate and render in an iframe
                    var iframe = document.createElement('iframe');
                    iframe.style.width = '100%';
                    iframe.style.height = '300px';
                    iframe.style.border = 'none';
                    
                    var boilerplate = `
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>HTML Preview</title>
                            <style>
                                body { background-color: #FFFFFF; color: #000000; font-family: sans-serif; }
                            </style>
                        </head>
                        <body>
                            ${code}
                        </body>
                        </html>
                    `;
                    
                    outputContainer.appendChild(iframe);
                    iframe.contentWindow.document.open();
                    iframe.contentWindow.document.write(boilerplate);
                    iframe.contentWindow.document.close();

                } else if (language === 'css') {
                    // For CSS, apply it to sample content within an iframe
                    var iframe = document.createElement('iframe');
                    iframe.style.width = '100%';
                    iframe.style.height = '300px';
                    iframe.style.border = 'none';
                    
                    var sampleHtml = `
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
                    // For JavaScript, execute and capture console logs
                    var outputLog = [];
                    var oldConsoleLog = console.log;
                    console.log = function(...args) {
                        const message = args.map(arg => (typeof arg === 'object' && arg !== null) ? JSON.stringify(arg, null, 2) : String(arg)).join(' ');
                        outputLog.push(message);
                        oldConsoleLog.apply(console, args);
                    };

                                                                                try {

                                                                                    new Function(code)();

                                                                                    var sanitizedOutput = $('<div>').text(outputLog.join('\n')).html();

                                                                                    outputContainer.innerHTML = '<div class="output-title">>> Output Console:</div><pre>' + (sanitizedOutput || 'Tidak ada output console.') + '</pre>';

                                                                                } catch (e) {

                                                                                    var sanitizedError = $('<div>').text(e.message).html();

                                                                                    outputContainer.innerHTML = '<div class="output-title" style="color: #cc0000;">>> Error:</div><pre>' + sanitizedError + '</pre>';

                                                                                } finally {

                                                                                    console.log = oldConsoleLog;

                                                                                }

                                                                            } else {

                                                                                // Fallback for other languages

                                                                                outputContainer.innerHTML = '<div class="output-title" style="color: #ffcc00;">>> Pratinjau output hanya tersedia untuk JavaScript, HTML, dan CSS saat ini.</div>';

                                    }

                                });

                            }

                    
                            // Dynamically load the mode script

                            var modeScript = document.createElement('script');

                            modeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/' + selectedLang.file;

                            modeScript.onload = function () {

                                initEditor(); // Initialize editor after the mode script has loaded

                            };

                            document.head.appendChild(modeScript);

                    
                        </script>

                    </body>

                    </html>


