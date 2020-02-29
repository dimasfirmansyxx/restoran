<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Pelanggan / Edit");
	$myfunc->set_title("Edit Pelanggan");

	include 'config/templates/header.php';

	if ( isset($_GET['id']) ) {
		$id = $_GET['id'];
		$_SESSION["id_pelanggan"] = $id;
		$get = $myfunc->get_data("SELECT * FROM tblpelanggan WHERE id_pelanggan = '$id'");
	} else {
		$myfunc->redirect($myfunc->baseurl . "cust.php");
	}

	if ( isset($_POST['submit']) ) {
		$data = [
			"id_pelanggan" => $_SESSION["id_pelanggan"],
			"nama" => $_POST['nama'],
			"jk" => $_POST['jk'],
			"nohp" => $_POST['nohp'],
			"alamat" => $_POST['alamat'],
		];
		unset($_SESSION["id_pelanggan"]);
		$myfunc->edit_pelanggan($data);
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
				<label>Jenis Kelamin</label>
				<select name="jk" class="form-control">
					<?php if ( $get['jk'] == "pria" ): ?>
						<option value="pria">Pria</option>
						<option value="wanita">Wanita</option>
					<?php else: ?>
						<option value="wanita">Wanita</option>
						<option value="pria">Pria</option>
					<?php endif ?>
				</select>
			</div>
			<div class="form-group">
				<label>Nomor Handphone</label>
				<input type="number" name="nohp" class="form-control" required value="<?= $get['nohp'] ?>">
			</div>			
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat" required><?= $get['alamat'] ?></textarea>
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