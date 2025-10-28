<form id="formKelas" action="<?= site_url('admin/kelas/kelas_editsave') ?>" method="post">
  <input type="hidden" name="id_kelas" value="<?= $kelas->id_kelas ?>">

  <div class="form-group">
    <label class="">Nama Kelas</label>
    <input type="text" 
           name="nama_kelas" 
           value="<?= $kelas->nama_kelas ?>" 
           class="form-control border-warning shadow-sm" 
           placeholder="Masukkan nama kelas..." 
           required>
  </div>

  <div class="form-group">
    <label class="">Tahun Ajaran</label>
    <input type="text" 
           name="tahun_ajaran" 
           value="<?= $kelas->tahun_ajaran ?>" 
           class="form-control border-warning shadow-sm" 
           placeholder="Masukkan tahun ajaran (contoh: 2023/2024)..." 
           required>
  </div>
  <div class="form-group">
    <label class="">Guru Wali</label>
    <select name="id_guru_wali" class="form-control border-warning shadow-sm">
        <option value="">-- Pilih Guru Wali --</option>
        <?php foreach ($guru_list as $guru) : ?>
            <option value="<?= $guru->id_guru; ?>" <?= ($guru->id_guru == $kelas->id_guru_wali) ? 'selected' : '' ?>><?= $guru->nama_guru; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="modal-footer bg-light">
    <button type="submit" class="btn btn-warning">
      <i class="fas fa-save"></i> <span class="d-none d-md-inline">Simpan</span>
    </button>
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
      <i class="fas fa-times"></i> <span class="d-none d-md-inline">Batal</span>
    </button>
  </div>
</form>