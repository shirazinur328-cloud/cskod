<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Materi untuk: <?= $pertemuan->nama_pertemuan ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Upload Materi</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul Materi</label>
                            <input type="text" name="judul_materi" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>File Materi</label>
                            <input type="file" name="file_materi" class="form-control" required>
                            <small class="form-text text-muted">Format: PDF, DOC, PPT, Gambar, atau Video (maks. 100MB)</small>
                        </div>
                        
                        <input type="hidden" name="id_pertemuan" value="<?= $id_pertemuan ?>">
                        
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="<?= base_url('guru/pertemuan/detail/'.$id_pertemuan); ?>" 
                           class="btn btn-secondary">Batal</a>
                    </form>
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger mt-3">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->