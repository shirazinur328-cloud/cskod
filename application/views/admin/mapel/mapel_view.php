<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-dark font-weight-bold">Mata Pelajaran</h1>

    <div class="row">
        <!-- Total Mapel -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-light border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mata Pelajaran</div>
                        <div class="h5 mb-0 font-weight-bold text-dark"><?= $total_mapel; ?></div>
                    </div>
                    <div class="rounded-circle bg-primary text-white p-2">
                        <i class="fas fa-book fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="mb-4 text-muted">Kelola data mata pelajaran.</p>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Daftar Mata Pelajaran</h6>
            <div>
                <button class="btn btn-light btn-sm text-primary" id="btnTambah" data-toggle="modal" data-target="#modal_frame">
                    <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Tambah Mapel</span>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-export"></i> Export
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('admin/mapel/export_pdf'); ?>">PDF</a>
                        <a class="dropdown-item" href="<?= base_url('admin/mapel/export_excel'); ?>">Excel</a>
                        <a class="dropdown-item" href="<?= base_url('admin/mapel/export_word'); ?>">Word</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="mapel" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Deskripsi</th>
                            <th>Guru Pengampu</th>
                            <th>Total Pertemuan</th>
                            <th>Status Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal_frame" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Mata Pelajaran</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" id="modal_content"></div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

<script>
$(document).ready(function() {
  var table_mapel = $("#mapel").DataTable({
    ajax: {
      url: "<?= site_url('admin/mapel/mapel_daftar'); ?>",
      type: "GET",
      dataSrc: "data"
    },
    columns: [
      { data: 'no' },
      { data: 'nama_mapel' },
      { data: 'deskripsi' },
      { data: 'guru' },
      { data: 'total_pertemuan' },
      { data: 'status_aktif' },
      { data: 'aksi' }
    ]
  });

  // Tambah
  $('#btnTambah').click(function() {
    $('#modal_content').load("<?= site_url('admin/mapel/mapel_add'); ?>");
  });

  // Detail
  $(document).on("click", ".btn-mapel-detail", function() {
    var id = $(this).data('id');
    $('#modal_content').load("<?= site_url('admin/mapel/mapel_detail/'); ?>" + id, function() {
      $('#modal_frame').modal('show');
    });
  });

  // Edit
  $(document).on("click", ".btn-mapel-edit", function() {
    var id = $(this).data('id');
    $('#modal_content').load("<?= site_url('admin/mapel/mapel_edit/'); ?>" + id, function() {
      $('#modal_frame').modal('show');
    });
  });

  // Hapus
  $(document).on("click", ".btn-mapel-hapus", function() {
    var id_mapel = $(this).data("id");
    var url = "<?= site_url('admin/mapel/mapel_delete_post'); ?>";

    bootbox.confirm({
        message: "Apakah Anda yakin ingin menghapus mata pelajaran ini?",
        buttons: {
            confirm: { label: "Hapus", className: "btn-danger" },
            cancel: { label: "Batal", className: "btn-secondary" }
        },
        callback: function(result) {
            if(result) {
                $.post(url, {id_mapel: id_mapel}, function(res) {
                    if(res.status === "sukses") {
                        toastr.success(res.pesan);
                        table_mapel.ajax.reload(null, false);
                    } else {
                        toastr.warning(res.pesan);
                    }
                }, "json");
            }
        }
    });
  });

  // Submit form Add/Edit
  $(document).on("submit", "#formMapel", function(e) {
    e.preventDefault();
    var form = $(this);
    $.post(form.attr('action'), form.serialize(), function(res) {
      if(res.status === 'sukses') {
        $('#modal_frame').modal('hide');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        toastr.success(res.pesan);
        table_mapel.ajax.reload(null, false);
      } else {
        toastr.error("Gagal menyimpan data");
      }
    }, 'json');
  });
});
</script>