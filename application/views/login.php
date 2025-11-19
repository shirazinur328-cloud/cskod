<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login LMS</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/murid_theme.css') ?>" rel="stylesheet">

     <!-- Custom styles for this page (DataTables) -->
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

</head>

<body>
	<!--  Body Wrapper -->
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
	data-sidebar-position="fixed" data-header-position="fixed">
	<div
	class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
	<div class="d-flex align-items-center justify-content-center w-100">
		<div class="row justify-content-center w-100">
			<div class="col-md-6 col-lg-4 col-xxl-3">
				<div class="card mb-0 rounded-5">
					<div class="card-body">
						<div class="d-flex flex-column justify-content-center align-items-center">
						<!-- <img src="https://storage.salpur.com/assets/images/logos/logosalsabila.png" 
						     alt="Logo Salsabila 5 Purworejo" 
						     style="width:200px;"> -->
						     <h3 class="mb-0">LOGIN</h3>
						     <p>Learning Management System</p>
						 </div>
						 <form action="" method="POST">
						 	<div class="form-floating mb-3">
						 		<label>
						 			<i class="ti ti-user"></i>
						 			Username <span class="text-danger">*</span>
						 		</label>
						 		<input type="text" class="form-control rounded-3" placeholder="Username" name="username" maxlength="50" required>
						 	</div>
						 	<div class="form-floating mb-3">
						 		<label>
						 			<i class="ti ti-key"></i>
						 			Password <span class="text-danger">*</span>
						 		</label>
						 		<input type="password" class="form-control rounded-3" placeholder="Password" name="password" maxlength="50" required>
						 	</div>
						 	<select name="role" class="form-control mb-3">
						 		<option value="murid">Murid</option>
						 		<option value="guru">Guru</option>
						 		<option value="admin">Admin</option>
						 	</select>
						 	<?php if ($this->session->flashdata('error')): ?>
						 		<div class="alert alert-danger p-3">
						 			<?= $this->session->flashdata('error') ?>
						 		</div>
						 	<?php endif ?>
						 	<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
						 	<button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-3">Login</a>
						 	</form>
						 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>

</body>

</html>