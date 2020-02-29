<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Meja / Edit");
	$myfunc->set_title("Edit Meja");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "owner") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}

	if ( isset($_GET['id']) ) {
		$id = $_GET['id'];
		$_SESSION["id_meja"] = $id;
		$get = $myfunc->get_data("SELECT * FROM tblmeja WHERE id_meja = '$id'");
	} else {
		$myfunc->redirect($myfunc->baseurl . "meja.php");
	}

	if ( isset($_POST['submit']) ) {
		$data = [
			"id_meja" => $_SESSION["id_meja"],
			"meja" => $_POST['nama'],
			"harga" => $_POST['harga'],
		];
		unset($_SESSION["id_meja"]);
		$myfunc->edit_meja($data);
	}
?>

<div class="card">
	<div class="card-header bg-dark text-white">
		<div class="row">
			<div class="col-12">
				Edit Meja
			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="form-group">
				<label>Nama Meja</label>
				<input type="text" name="nama" class="form-control" required autocomplete="off" value="<?= $get['meja'] ?>">
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