<form id="formSertifikat" action="<?= site_url('admin/sertifikat/sertifikat_addsave') ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="">Nama Sertifikat</label>
    <input type="text" 
           name="nama_sertifikat" 
           class="form-control border-primary shadow-sm" 
           placeholder="Masukkan nama sertifikat..." 
           required>
  </div>
  <div class="form-group">
    <label class="">Mata Pelajaran</label>
    <select name="id_mapel" class="form-control border-primary shadow-sm" required>
        <option value="">-- Pilih Mata Pelajaran --</option>
        <?php foreach ($mapel_list as $mapel) : ?>
            <option value="<?= $mapel->id_mapel ?>"><?= $mapel->nama_mapel ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label class="">Template Sertifikat (PNG)</label>
    <input type="file"
           name="template_file"
           class="form-control-file border shadow-sm"
           accept=".png"
           required>
    <small class="form-text text-muted">Ukuran maksimal 2MB, format PNG.</small>
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