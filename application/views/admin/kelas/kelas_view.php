<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-dark font-weight-bold">Data Kelas</h1>

    <div class="row">
        <!-- Total Kelas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-light border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kelas</div>
                        <div class="h5 mb-0 font-weight-bold text-dark"><?= $total_kelas; ?></div>
                    </div>
                    <div class="rounded-circle bg-primary text-white p-2">
                        <i class="fas fa-chalkboard fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Jumlah Murid per Kelas -->
        <?php foreach ($list as $kelas_stat) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-light border-left-info shadow h-100 py-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Murid di Kelas <?= $kelas_stat->nama_kelas; ?></div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?= $kelas_stat->jumlah_murid; ?></div>
                        </div>
                        <div class="rounded-circle bg-info text-white p-2">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <p class="mb-4 text-muted">Kelola data kelas.</p>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Daftar Kelas</h6>
            <div>
                <button class="btn btn-primary btn-sm rounded" style="background-color: #2563EB; border-color: #2563EB; color: white;" id="btnTambah">
                    <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Tambah Kelas</span>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle rounded" style="background-color: #16A34A; border-color: #16A34A; color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-export"></i> <span class="d-none d-md-inline">Export</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('admin/kelas/export_pdf'); ?>">PDF</a>
                        <a class="dropdown-item" href="<?= base_url('admin/kelas/export_excel'); ?>">Excel</a>
                        <a class="dropdown-item" href="<?= base_url('admin/kelas/export_word'); ?>">Word</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="kelas" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Jumlah Murid</th>
                            <th>Guru Wali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>


        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  var table_kelas = $("#kelas").DataTable({
    ajax: {
      url: "<?= site_url('admin/kelas/kelas_daftar'); ?>",
      type: "GET",
      dataSrc: "data"
    },
    columns: [
      { data: 'no' },
      { data: 'nama_kelas' },
      { data: 'tahun_ajaran' },
      { data: 'jumlah_murid' },
      { data: 'guru_wali' },
      { data: 'aksi' }
    ]
  });

  // Hapus
  $(document).on("click", ".btn-kelas-hapus", function() {
    var id_kelas = $(this).data("id");
    var url = "<?= site_url('admin/kelas/kelas_delete_post'); ?>";

    bootbox.confirm({
        message: "Apakah Anda yakin ingin menghapus data kelas ini?",
        buttons: {
            confirm: {
                label: '<i class="fa fa-check"></i> Hapus',
                className: 'btn-danger'
            },
            cancel: {
                label: '<i class="fa fa-times"></i> Batal',
                className: 'btn-secondary'
            }
        },
        callback: function(result) {
            if(result) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id_kelas: id_kelas},
                    dataType: 'json',
                    success: function(res) {
                        if(res.status === "sukses") {
                            toastr.success(res.pesan);
                            table_kelas.ajax.reload(null, false);
                        } else {
                            toastr.warning(res.pesan);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Gagal menghapus data. Terjadi kesalahan.');
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    });
  });

  // Dynamic modal creation and handling
  function loadModalContent(url, title) {
    // Remove any existing modals to prevent conflicts
    $('.dynamic-modal').remove();

    // Create modal HTML
    var modalHtml = `
      <div class="modal fade dynamic-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">${title}</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="text-center p-4">
                <i class="fas fa-spinner fa-spin fa-2x"></i>
                <p>Loading...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    // Add modal to body
    $('body').append(modalHtml);

    // Get reference to the newly created modal
    var $modal = $('.dynamic-modal').last();

    // Load content into modal body
    $modal.find('.modal-body').load(url, function(response, status, xhr) {
      if (status === "error") {
        $modal.find('.modal-body').html('<div class="alert alert-danger">Error loading content.</div>');
      }
    });

    // Show the modal
    $modal.modal('show');

    // Clean up when modal is closed
    $modal.on('hidden.bs.modal', function() {
      $(this).remove(); // Remove modal from DOM when closed
    });
  }

  // Tambah
  $('#btnTambah').click(function() {
    loadModalContent("<?= site_url('admin/kelas/kelas_add'); ?>", "Tambah Kelas");
  });

  // Detail
  $(document).on("click", ".btn-kelas-detail", function() {
    var id = $(this).data('id');
    loadModalContent("<?= site_url('admin/kelas/kelas_detail/'); ?>" + id, "Detail Kelas");
  });

  // Edit
  $(document).on("click", ".btn-kelas-edit", function() {
    var id = $(this).data('id');
    loadModalContent("<?= site_url('admin/kelas/kelas_edit/'); ?>" + id, "Edit Kelas");
  });

  // Detail Murid from Kelas Detail
  $(document).on("click", ".btn-murid-detail", function() {
    var id = $(this).data('id');
    loadModalContent("<?= site_url('admin/murid/murid_detail/'); ?>" + id, "Detail Murid");
  });

  // Submit form Add/Edit with AJAX
  $(document).on("submit", "#formKelas", function(e) {
    e.preventDefault();
    var form = $(this);
    var submitButton = form.find('button[type="submit"]');
    var modal = form.closest('.modal');

    // Disable submit button to prevent multiple submissions
    submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

    $.post(form.attr('action'), form.serialize(), function(res) {
      if(res.status === 'sukses') {
        modal.modal('hide');
        toastr.success(res.pesan);
        table_kelas.ajax.reload(null, false);
      } else {
        toastr.error("Gagal menyimpan data");
      }
    }, 'json').always(function() {
      // Re-enable submit button
      submitButton.prop('disabled', false).html('<i class="fas fa-save"></i> <span class="d-none d-md-inline">Simpan</span>');
    });
  });
});
</script>