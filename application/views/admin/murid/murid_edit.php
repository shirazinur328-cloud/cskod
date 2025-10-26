<form id="formMurid" action="<?= site_url('admin/murid/murid_editsave') ?>" method="post">
  <input type="hidden" name="id_murid" value="<?= $murid->id_murid ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="">Nama Murid</label>
                <input type="text" name="nama_murid" value="<?= $murid->nama_murid ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan nama murid..." required>
            </div>
            <div class="form-group">
                <label class="">Email</label>
                <input type="email" name="email" value="<?= $murid->email ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan email..." required>
            </div>
            <div class="form-group">
                <label class="">No. Telepon</label>
                <input type="text" name="no_telp" value="<?= $murid->no_telp ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan nomor telepon..." required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="">Username</label>
                <input type="text" name="username" value="<?= $murid->username ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan username..." required>
            </div>
            <div class="form-group">
                <label class="">Password</label>
                <input type="password" name="password" class="form-control border-warning shadow-sm" placeholder="Kosongkan jika tidak ingin diubah">
            </div>
            <div class="form-group">
                <label class="">Kelas</label>
                <select name="id_kelas" class="form-control border-warning shadow-sm" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $kls) : ?>
                        <option value="<?= $kls->id_kelas ?>" <?= ($kls->id_kelas == $murid->id_kelas) ? 'selected' : '' ?>><?= $kls->nama_kelas ?> (<?= $kls->tahun_ajaran ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
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