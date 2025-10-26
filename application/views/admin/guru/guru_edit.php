<form id="formGuru" action="<?= site_url('admin/guru/guru_editsave') ?>" method="post">
  <input type="hidden" name="id_guru" value="<?= $guru->id_guru ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="">Nama Guru</label>
                <input type="text" name="nama_guru" value="<?= $guru->nama_guru ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan nama guru..." required>
            </div>
            <div class="form-group">
                <label class="">Email</label>
                <input type="email" name="email" value="<?= $guru->email ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan email..." required>
            </div>
            <div class="form-group">
                <label class="">No. Telepon</label>
                <input type="text" name="no_telp" value="<?= $guru->no_telp ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan nomor telepon..." required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="">Username</label>
                <input type="text" name="username" value="<?= $guru->username ?>" class="form-control border-warning shadow-sm" placeholder="Masukkan username..." required>
            </div>
            <div class="form-group">
                <label class="">Password</label>
                <input type="password" name="password" class="form-control border-warning shadow-sm" placeholder="Kosongkan jika tidak ingin diubah">
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