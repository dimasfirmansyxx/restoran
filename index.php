<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda");
	$myfunc->set_title("Beranda");

	include 'config/templates/header.php';
?>

<div class="row mb-2">
	<div class="col-md-4">
		<div class="card bg-primary text-white">
			<div class="card-body">
				<h4>14</h4>
				<p>Pelanggan Terdaftar</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-success text-white">
			<div class="card-body">
				<h4>14</h4>
				<p>Jumlah Menu</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-danger text-white">
			<div class="card-body">
				<h4>14</h4>
				<p>Jumlah Orderan</p>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'config/templates/footer.php';
?>