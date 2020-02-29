<!DOCTYPE html>
<html>
<head>
	<title><?= $myfunc->title ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
						<?php if ( $_SESSION["user_logged"]['privilege'] == "administrator" ): ?>
							<a href="<?= $myfunc->baseurl ?>menu.php" class="nav-item nav-link">Entri Menu</a>
							<a href="<?= $myfunc->baseurl ?>meja.php" class="nav-item nav-link">Entri Meja</a>
							<a href="<?= $myfunc->baseurl ?>order.php" class="nav-item nav-link">Entri Order</a>
							<a href="<?= $myfunc->baseurl ?>transaksi.php" class="nav-item nav-link">Entri Transaksi</a>
							<a href="<?= $myfunc->baseurl ?>cust.php" class="nav-item nav-link">Entri Pelanggan</a>
							<a href="<?= $myfunc->baseurl ?>user.php" class="nav-item nav-link">Entri Pengguna</a>
							<a href="<?= $myfunc->baseurl ?>laporan.php" class="nav-item nav-link">Laporan</a>
						<?php elseif ( $_SESSION["user_logged"]['privilege'] == "waiter" ): ?>
							<a href="<?= $myfunc->baseurl ?>order.php" class="nav-item nav-link">Entri Order</a>
							<a href="<?= $myfunc->baseurl ?>cust.php" class="nav-item nav-link">Entri Pelanggan</a>
						<?php elseif ( $_SESSION["user_logged"]['privilege'] == "kasir" ): ?>
							<a href="<?= $myfunc->baseurl ?>transaksi.php" class="nav-item nav-link">Entri Transaksi</a>
							<a href="<?= $myfunc->baseurl ?>cust.php" class="nav-item nav-link">Entri Pelanggan</a>
						<?php elseif ( $_SESSION["user_logged"]['privilege'] == "owner" ): ?>
							<a href="<?= $myfunc->baseurl ?>menu.php" class="nav-item nav-link">Entri Menu</a>
							<a href="<?= $myfunc->baseurl ?>meja.php" class="nav-item nav-link">Entri Meja</a>
							<a href="<?= $myfunc->baseurl ?>cust.php" class="nav-item nav-link">Entri Pelanggan</a>
							<a href="<?= $myfunc->baseurl ?>user.php" class="nav-item nav-link">Entri Pengguna</a>
							<a href="<?= $myfunc->baseurl ?>laporan.php" class="nav-item nav-link">Laporan</a>
						<?php endif ?>
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
					<?php if ( isset($_SESSION["flash_data"]) ): ?>
						<div class="col-12 mt-4">
							<div class="alert alert-primary" role="alert">
							  <?= $_SESSION["flash_data"] ?>
							  <?php unset($_SESSION["flash_data"]) ?>
							</div>
						</div>
					<?php endif ?>
				</div>
			<?php endif ?>