<?php $this->load->view('templates/siswa/head'); ?>
<?php $this->load->view('templates/siswa/navbar'); ?>
<?php $this->load->view('templates/siswa/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kerjakan Tugas: <?php echo htmlspecialchars($tugas['judul_tugas']); ?></h1>

    <!-- Task Details -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Tugas</h6>
        </div>
        <div class="card-body">
            <p><?php echo nl2br(htmlspecialchars($tugas['deskripsi'])); ?></p>
            <hr>
            <p class="mb-0"><strong>Deadline:</strong> <?php echo date('d F Y, H:i', strtotime($tugas['deadline'])); ?></p>
        </div>
    </div>

    <!-- Submission Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Pengumpulan Tugas</h6>
        </div>
        <div class="card-body">
            <!-- Display Success/Error Messages -->
            <?php if ($this->session->flashdata('success')):
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif;
            ?>
            <?php if ($this->session->flashdata('error')):
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif;
            ?>

            <?php echo form_open_multipart('murid/tugas/submit_tugas'); ?>
                <input type="hidden" name="id_tugas" value="<?php echo $tugas['id_tugas']; ?>">
                
                <div class="form-group">
                    <label for="file_jawaban">Upload File Jawaban</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_jawaban" name="file_jawaban" required>
                        <label class="custom-file-label" for="file_jawaban">Pilih file...</label>
                    </div>
                    <small class="form-text text-muted">Tipe file yang diizinkan: gif, jpg, png, pdf, doc, docx, zip, rar. Ukuran maksimal: 10MB.</small>
                </div>
                
                <button type="submit" class="btn btn-primary">Kumpulkan Tugas</button>
                <a href="<?php echo site_url('murid/dashboard/subject_detail/' . $tugas['id_mapel']); ?>" class="btn btn-secondary">Kembali</a>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/siswa/footer'); ?>

<script>
// Script to show the selected file name in the custom file input
$(".custom-file-input").on("change", function() {
   let fileName = $(this).val().split("\\").pop();
   $(this).next(".custom-file-label").addClass("selected").html(fileName);
});
</script>