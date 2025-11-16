<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-dark font-weight-bold">Data Murid</h1>

    <div class="row">
        <!-- Total Murid -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Murid</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_murid; ?></div>
                    </div>
                    <div class="rounded-circle bg-primary text-white p-2">
                        <i class="fas fa-user-graduate fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="murid-filter-section">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filter_kelas">Filter Kelas</label>
                    <select class="form-control" id="filter_kelas">
                        <option value="">Semua Kelas</option>
                        <!-- Options will be populated via JavaScript -->
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="search_nama">Cari Nama Murid</label>
                    <input type="text" class="form-control" id="search_nama" placeholder="Cari nama murid...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filter_status">Status</label>
                    <select class="form-control" id="filter_status">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="lulus">Lulus</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <p class="mb-4 text-muted">Kelola data murid.</p>

    <div class="murid-data-table">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Daftar Murid</h6>
                <div>
                    <button class="btn btn-primary btn-sm rounded" style="background-color: #2563EB; border-color: #2563EB; color: white;" id="btnTambah">
                        <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Tambah Murid</span>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle rounded" style="background-color: #16A34A; border-color: #16A34A; color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file-export"></i> <span class="d-none d-md-inline">Export</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('admin/murid/export_pdf'); ?>">PDF</a>
                            <a class="dropdown-item" href="<?= base_url('admin/murid/export_excel'); ?>">Excel</a>
                            <a class="dropdown-item" href="<?= base_url('admin/murid/export_word'); ?>">Word</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="murid" width="100%" cellspacing="0">
                        <thead class="thead-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Murid</th>
                                <th>Kelas</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
    // Populate kelas filter
    $.get("<?= site_url('admin/murid/get_kelas_list'); ?>", function(data) {
        const kelasSelect = $('#filter_kelas');
        data.forEach(function(kelas) {
            kelasSelect.append(`<option value="${kelas.id_kelas}">${kelas.nama_kelas}</option>`);
        });
    });

    var table_murid = $("#murid").DataTable({
        ajax: {
            url: "<?= site_url('admin/murid/murid_daftar'); ?>",
            type: "GET",
            dataSrc: "data",
            data: function(d) {
                d.filter_kelas = $('#filter_kelas').val();
                d.search_nama = $('#search_nama').val();
                d.filter_status = $('#filter_status').val();
            }
        },
        columns: [
            {
                data: 'no',
                className: 'text-center'
            },
            { data: 'nama_murid' },
            {
                data: 'nama_kelas',
                defaultContent: '-'
            },
            { data: 'email' },
            { data: 'no_telp' },
            {
                data: 'status',
                render: function(data) {
                    let statusClass = data.toLowerCase() === 'aktif' ? 'status-aktif' : 'status-lulus';
                    return `<span class="status-badge ${statusClass}">${data}</span>`;
                }
            },
            {
                data: 'aksi',
                orderable: false,
                searchable: false,
                className: 'btn-action-group'
            }
        ],
        columnDefs: [
            {
                targets: [0],
                className: 'text-center'
            },
            {
                targets: [4],
                className: 'text-break'
            }
        ]
    });

    // Apply filters
    $('#filter_kelas, #search_nama, #filter_status').on('change keyup', function() {
        table_murid.ajax.reload();
    });

    // Hapus
    $(document).on("click", ".btn-murid-hapus", function() {
        var id_murid = $(this).data("id");
        var url = "<?= site_url('admin/murid/murid_delete_post'); ?>";

        bootbox.confirm({
            message: "Apakah Anda yakin ingin menghapus data murid ini?",
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
                        data: {id_murid: id_murid},
                        dataType: 'json',
                        success: function(res) {
                            if(res.status === "sukses") {
                                toastr.success(res.pesan);
                                table_murid.ajax.reload(null, false);
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
        loadModalContent("<?= site_url('admin/murid/murid_add'); ?>", "Tambah Murid");
    });

    // Detail
    $(document).on("click", ".btn-murid-detail", function() {
        var id = $(this).data('id');
        loadModalContent("<?= site_url('admin/murid/murid_detail/'); ?>" + id, "Detail Murid");
    });

    // Edit
    $(document).on("click", ".btn-murid-edit", function() {
        var id = $(this).data('id');
        loadModalContent("<?= site_url('admin/murid/murid_edit/'); ?>" + id, "Edit Murid");
    });

    // Submit form Add/Edit with AJAX
    $(document).on("submit", "#formMurid", function(e) {
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
                table_murid.ajax.reload(null, false);
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