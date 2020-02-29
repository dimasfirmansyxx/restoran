<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Pelanggan / Tambah");
	$myfunc->set_title("Tambah Pelanggan");

	include 'config/templates/header.php';

	if ( isset($_POST['submit']) ) {
		$myfunc->tambah_pelanggan($_POST);
	}
?>

<div class="card">
	<div class="card-header bg-dark text-white">
		<div class="row">
			<div class="col-12">
				Tambah Pelanggan
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
				<label>Jenis Kelamin</label>
				<select name="jk" class="form-control">
					<option value="pria">Pria</option>
					<option value="wanita">Wanita</option>
				</select>
			</div>
			<div class="form-group">
				<label>Nomor Handphone</label>
				<input type="number" name="nohp" class="form-control" required>
			</div>			
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat" required></textarea>
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