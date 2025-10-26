<form id="formKelas" action="<?= site_url('admin/kelas/kelas_addsave') ?>" method="post">
  <div class="form-group">
    <label class="">Nama Kelas</label>
    <input type="text" 
           name="nama_kelas" 
           class="form-control border-primary shadow-sm" 
           placeholder="Masukkan nama kelas..." 
           required>
  </div>
  <div class="form-group">
    <label class="">Tahun Ajaran</label>
    <input type="text" 
           name="tahun_ajaran" 
           class="form-control border-primary shadow-sm" 
           placeholder="Masukkan tahun ajaran (contoh: 2023/2024)..." 
           required>
  </div>

  <div class="modal-footer bg-light">
    <button type="submit" class="btn btn-primary">
      <i class="fas fa-save"></i> <span class="d-none d-md-inline">Simpan</span>
    </button>
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Batal</span>
    </button>
  </div>
</form>