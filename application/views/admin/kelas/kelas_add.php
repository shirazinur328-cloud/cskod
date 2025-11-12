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
  <div class="form-group">
    <label class="">Guru Wali</label>
    <select name="id_guru_wali" class="form-control border-primary shadow-sm">
        <option value="">-- Pilih Guru Wali --</option>
        <?php foreach ($guru_list as $guru) : ?>
            <option value="<?= $guru->id_guru; ?>"><?= $guru->nama_guru; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label class="">Mata Pelajaran</label>
    <select name="mapel_ids[]" multiple class="form-control border-primary shadow-sm" style="height: 150px;">
        <option value="" disabled>-- Pilih Mata Pelajaran --</option>
        <?php /* Controller perlu mengirimkan $all_mapel */ ?>
        <?php if (!empty($all_mapel)) : ?>
            <?php foreach ($all_mapel as $mapel) : ?>
                <option value="<?= $mapel->id_mapel; ?>"><?= $mapel->nama_mapel; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <small class="form-text text-muted">Tahan tombol Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu.</small>
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