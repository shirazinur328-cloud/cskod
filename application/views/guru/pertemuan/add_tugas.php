<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Tugas untuk: <?= $pertemuan->nama_pertemuan ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Pembuatan Tugas</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Judul Tugas</label>
                            <input type="text" name="judul_tugas" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="datetime-local" name="deadline" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tipe_tugas">Tipe Tugas</label>
                            <select class="form-control" id="tipe_tugas" name="tipe_tugas" required>
                                <option value="file">Upload File</option>
                                <option value="coding">Coding</option>
                                <option value="text">Jawaban Teks</option>
                            </select>
                        </div>

                        <div class="form-group" id="bahasa_group" style="display: none;">
                            <label for="bahasa">Bahasa Pemrograman</label>
                            <select class="form-control" id="bahasa" name="bahasa">
                                <option value="">Pilih Bahasa</option>
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                                <option value="javascript">JavaScript</option>
                                <option value="python">Python</option>
                                <option value="java">Java</option>
                                <option value="cpp">C++</option>
                                <option value="c">C</option>
                                <option value="php">PHP</option>
                            </select>
                        </div>
                        
                        <input type="hidden" name="id_pertemuan" value="<?= $id_pertemuan ?>">
                        <input type="hidden" name="id_mapel" value="<?= $pertemuan->id_mapel ?>">
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('guru/pertemuan/detail/'.$id_pertemuan); ?>" 
                           class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipeTugasSelect = document.getElementById('tipe_tugas');
    const bahasaGroup = document.getElementById('bahasa_group');

    function toggleBahasaGroup() {
        if (tipeTugasSelect.value === 'coding') {
            bahasaGroup.style.display = 'block';
        } else {
            bahasaGroup.style.display = 'none';
        }
    }

    tipeTugasSelect.addEventListener('change', toggleBahasaGroup);

    // Initial call to set visibility based on default selected option
    toggleBahasaGroup();
});
</script>