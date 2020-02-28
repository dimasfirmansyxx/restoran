<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Menu / Tambah");
	$myfunc->set_title("Tambah Menu");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "owner") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}

	if ( isset($_POST['submit']) ) {
		$myfunc->tambah_menu($_POST);
	}
?>

<div class="card">
	<div class="card-header bg-dark text-white">
		<div class="row">
			<div class="col-12">
				Tambah Menu
			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="form-group">
				<label>Nama Menu</label>
				<input type="text" name="nama" class="form-control" required autocomplete="off">
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="number" name="harga" class="form-control" required autocomplete="off">
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</div>
		</form>
	</div>
</div>

<?php 
	include 'config/templates/footer.php';
?>