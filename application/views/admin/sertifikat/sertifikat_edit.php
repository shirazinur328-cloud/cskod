<form id="formSertifikat" action="<?= site_url('admin/sertifikat/sertifikat_editsave') ?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id_sertifikat" value="<?= $sertifikat->id_sertifikat ?>">
  <div class="form-group">
    <label class="">Nama Sertifikat</label>
    <input type="text" 
           name="nama_sertifikat" 
           value="<?= $sertifikat->nama_sertifikat ?>" 
           class="form-control border-warning shadow-sm" 
           placeholder="Masukkan nama sertifikat..." 
           required>
  </div>
  <div class="form-group">
    <label class="">Mata Pelajaran</label>
    <select name="id_mapel" class="form-control border-warning shadow-sm" required>
        <option value="">-- Pilih Mata Pelajaran --</option>
        <?php foreach ($mapel_list as $mapel) : ?>
            <option value="<?= $mapel->id_mapel ?>" <?= ($mapel->id_mapel == $sertifikat->id_mapel) ? 'selected' : '' ?>><?= $mapel->nama_mapel ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label class="">Template Sertifikat (PDF)</label>
    <input type="file" 
           name="template_file" 
           class="form-control-file border shadow-sm" 
           accept=".pdf">
    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah template. Ukuran maksimal 2MB, format PDF.</small>
    <?php if ($sertifikat->template_file) : ?>
        <p class="mt-2">File saat ini: <a href="<?= base_url('uploads/sertifikat_templates/' . $sertifikat->template_file); ?>" target="_blank"><?= $sertifikat->template_file; ?></a></p>
    <?php endif; ?>
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