<!DOCTYPE html>
<html>
<head>
	<title><?= $myfunc->title ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<button class="navbar-toggler" data-toggle="collapse" data-target="#mynav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mynav">
				<div class="navbar-nav">
					<a href="#" class="nav-item nav-link">Beranda</a>
					<a href="#" class="nav-item nav-link">Entri Menu</a>
					<a href="#" class="nav-item nav-link">Entri Order</a>
					<a href="#" class="nav-item nav-link">Entri Transaksi</a>
					<a href="#" class="nav-item nav-link">Laporan</a>
				</div>
				<div class="navbar-nav ml-auto">
					<a href="#" class="nav-item nav-link">Login</a>
					<a href="#" class="nav-item nav-link">Logout</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="container mt-5">
		<div class="row mb-4">
			<div class="col-12 mb-2 breadcrumbs">
				<small><?= $myfunc->breadcrumb ?></small>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<h6>Hi, Dimas Firmansyah</h6>
							</div>
							<div class="col-md-6 text-right">
								<?= date("l, d F Y") ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>