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
	<?php if ( isset($_SESSION["user_logged"]) ): ?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<button class="navbar-toggler" data-toggle="collapse" data-target="#mynav">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mynav">
					<div class="navbar-nav">
						<a href="<?= $myfunc->baseurl ?>index.php" class="nav-item nav-link">Beranda</a>
						<a href="<?= $myfunc->baseurl ?>menu.php" class="nav-item nav-link">Entri Menu</a>
						<a href="<?= $myfunc->baseurl ?>order.php" class="nav-item nav-link">Entri Order</a>
						<a href="<?= $myfunc->baseurl ?>transaksi.php" class="nav-item nav-link">Entri Transaksi</a>
						<a href="<?= $myfunc->baseurl ?>laporan.php" class="nav-item nav-link">Laporan</a>
					</div>
					<div class="navbar-nav ml-auto">
						<a href="<?= $myfunc->baseurl ?>profil.php" class="nav-item nav-link">Profil</a>
						<a href="<?= $myfunc->baseurl ?>index.php?logout=" class="nav-item nav-link">Logout</a>
					</div>
				</div>
			</div>
		</nav>
	<?php endif ?>

		<div class="container mt-5">
			<?php if ( isset($_SESSION["user_logged"]) ): ?>
				<div class="row mb-4">
					<div class="col-12 mb-2 breadcrumbs">
						<small><?= $myfunc->breadcrumb ?></small>
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<h6>Hi, <?= $_SESSION["user_logged"]['nama'] ?></h6>
									</div>
									<div class="col-md-6 text-right">
										<?= date("l, d F Y") ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>