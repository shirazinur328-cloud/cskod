<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Pertemuan Baru</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Pembuatan Pertemuan</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Nama Pertemuan</label>
                            <input type="text" name="nama_pertemuan" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        
                        <input type="hidden" name="id_mapel" value="<?= $id_mapel ?>">
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('guru/mapel/classroom/'.$id_mapel.'/'.$id_kelas); ?>" 
                           class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->