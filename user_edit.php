<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / User / Edit");
	$myfunc->set_title("Edit User");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "owner") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}

	if ( isset($_GET['id']) ) {
		$id = $_GET['id'];
		$_SESSION["id_user"] = $id;
		$get = $myfunc->get_data("SELECT * FROM tbluser WHERE id_user = '$id'");
	} else {
		$myfunc->redirect($myfunc->baseurl . "user.php");
	}

	if ( isset($_POST['submit']) ) {
		$data = [
			"id_user" => $_SESSION["id_user"],
			"nama" => $_POST['nama'],
			"privilege" => $_POST['privilege']
		];
		unset($_SESSION["id_user"]);
		$myfunc->edit_user($data);
	}
?>

<div class="card">
	<div class="card-header bg-dark text-white">
		<div class="row">
			<div class="col-12">
				Edit Pelanggan
			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control" required autocomplete="off" value="<?= $get['nama'] ?>">
			</div>
			<div class="form-group">
				<label>Hak Akses</label>
				<select name="privilege" class="form-control">
					<?php if ( $get['privilege'] == "administrator" ): ?>
						<option value="administrator">Administrator</option>
						<option value="owner">Owner</option>
						<option value="kasir">Kasir</option>
						<option value="waiter">Waiter</option>
					<?php elseif ( $get['privilege'] == "owner" ): ?>
						<option value="owner">Owner</option>
						<option value="administrator">Administrator</option>
						<option value="kasir">Kasir</option>
						<option value="waiter">Waiter</option>
					<?php elseif ( $get['privilege'] == "kasir" ): ?>
						<option value="kasir">Kasir</option>
						<option value="administrator">Administrator</option>
						<option value="owner">Owner</option>
						<option value="waiter">Waiter</option>
					<?php elseif ( $get['privilege'] == "waiter" ): ?>
						<option value="waiter">Waiter</option>
						<option value="administrator">Administrator</option>
						<option value="owner">Owner</option>
						<option value="kasir">Kasir</option>
					<?php endif ?>
				</select>
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