<form id="formMapel" action="<?= site_url('admin/mapel/mapel_editsave') ?>" method="post">
  <input type="hidden" name="id_mapel" value="<?= $mapel->id_mapel ?>">

  <div class="form-group">
    <label class="">Nama Mata Pelajaran</label>
    <input type="text" 
           name="nama_mapel" 
           value="<?= $mapel->nama_mapel ?>" 
           class="form-control border-warning shadow-sm" 
           placeholder="Masukkan nama mata pelajaran..." 
           required>
  </div>

  <div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi" 
              class="form-control border-warning shadow-sm" 
              required><?= $mapel->deskripsi ?></textarea>
  </div>

  <div class="form-group">
    <label class="">Guru Pengampu</label>
    <select name="id_guru" class="form-control border-warning shadow-sm" required>
        <option value="">-- Pilih Guru --</option>
        <?php foreach ($gurus as $guru) : ?>
            <option value="<?= $guru->id_guru ?>" <?= ($guru->id_guru == $mapel->id_guru) ? 'selected' : '' ?>><?= $guru->nama_guru ?></option>
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