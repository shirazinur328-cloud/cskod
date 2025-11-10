<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Tugas untuk: <?= $pertemuan->judul_pertemuan ?></h1>
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