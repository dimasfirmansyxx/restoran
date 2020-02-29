<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / User / Tambah");
	$myfunc->set_title("Tambah User");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "owner") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}

	if ( isset($_POST['submit']) ) {
		$myfunc->tambah_user($_POST);
	}
?>

<div class="card">
	<div class="card-header bg-dark text-white">
		<div class="row">
			<div class="col-12">
				Tambah User
			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control" required autocomplete="off">
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" maxlength="16" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" required>
			</div>			
			<div class="form-group">
				<label>Hak Akses</label>
				<select name="privilege" class="form-control">
					<option value="administrator">Administrator</option>
					<option value="owner">Owner</option>
					<option value="kasir">Kasir</option>
					<option value="waiter">Waiter</option>
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