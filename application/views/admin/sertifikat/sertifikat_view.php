<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-dark font-weight-bold">Manajemen Sertifikat</h1>

    <div class="row">
        <!-- Total Sertifikat -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-light border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sertifikat</div>
                        <div class="h5 mb-0 font-weight-bold text-dark"><?= $total_sertifikat; ?></div>
                    </div>
                    <div class="rounded-circle bg-primary text-white p-2">
                        <i class="fas fa-certificate fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="mb-4 text-muted">Kelola template dan validasi sertifikat.</p>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Daftar Sertifikat</h6>
            <div>
                <button class="btn btn-primary btn-sm rounded" style="background-color: #2563EB; border-color: #2563EB; color: white;" id="btnTambah">
                    <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Tambah Sertifikat</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="sertifikat" width="100%" cellspacing="0">
                    <thead class="thead-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Sertifikat</th>
                            <th>Mata Pelajaran</th>
                            <th>Jumlah Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
  var table_sertifikat = $("#sertifikat").DataTable({
    ajax: {
      url: "<?= site_url('admin/sertifikat/sertifikat_daftar'); ?>",
      type: "GET",
      dataSrc: "data"
    },
    columns: [
      { data: 'no' },
      { data: 'nama_sertifikat' },
      { data: 'nama_mapel' },
      { data: 'jumlah_keluar' },
      { data: 'aksi' }
    ]
  });

  // Hapus
  $(document).on("click", ".btn-sertifikat-hapus", function() {
    var id_sertifikat = $(this).data("id");
    var url = "<?= site_url('admin/sertifikat/sertifikat_delete_post'); ?>";

    bootbox.confirm({
        message: "Apakah Anda yakin ingin menghapus data sertifikat ini?",
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
                    data: {id_sertifikat: id_sertifikat},
                    dataType: 'json',
                    success: function(res) {
                        if(res.status === "sukses") {
                            toastr.success(res.pesan);
                            table_sertifikat.ajax.reload(null, false);
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
    loadModalContent("<?= site_url('admin/sertifikat/sertifikat_add'); ?>", "Tambah Sertifikat");
  });

  // Detail
  $(document).on("click", ".btn-sertifikat-detail", function() {
    var id = $(this).data('id');
    loadModalContent("<?= site_url('admin/sertifikat/sertifikat_detail/'); ?>" + id, "Detail Sertifikat");
  });

  // Edit
  $(document).on("click", ".btn-sertifikat-edit", function() {
    var id = $(this).data('id');
    loadModalContent("<?= site_url('admin/sertifikat/sertifikat_edit/'); ?>" + id, "Edit Sertifikat");
  });

  // Submit form Add/Edit with AJAX
  $(document).on("submit", "#formSertifikat", function(e) {
    e.preventDefault();
    var form = $(this);
    var submitButton = form.find('button[type="submit"]');
    var modal = form.closest('.modal');
    var formData = new FormData(form[0]);

    // Disable submit button to prevent multiple submissions
    submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(res) {
            if(res.status === 'sukses') {
                modal.modal('hide');
                toastr.success(res.pesan);
                table_sertifikat.ajax.reload(null, false);
            } else {
                toastr.error("Gagal menyimpan data: " + res.pesan);
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Gagal menyimpan data. Terjadi kesalahan.');
            console.error(xhr.responseText);
        }
    }).always(function() {
        // Re-enable submit button
        submitButton.prop('disabled', false).html('<i class="fas fa-save"></i> <span class="d-none d-md-inline">Simpan</span>');
    });
  });
});
</script>