<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Order");
	$myfunc->set_title("Order");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "waiter") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}


	$get_data = $myfunc->get_all_menu();
	$get_cust = $myfunc->get_all_pelanggan();
?>

<div class="row">
	<div class="col-12 text-right mb-4">
		<form class="form-inline">
			<select class="form-control mr-3" required name="pelanggan">
				<option value="0">--- Pilih Pelanggan ---</option>
				<?php foreach ($get_cust as $cust): ?>
					<option value="<?= $cust['id_pelanggan'] ?>"><?= $cust['nama'] ?></option>
				<?php endforeach ?>
			</select>
			<button class="btn btn-success mr-3" type="submit" name="pesan">Pesan</button>
			<a href="#" class="btn btn-danger mr-3">Batal</a>
		</form>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header bg-dark text-white">
				List Menu
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Harga</th>
								<th width="50">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( $get_data == 3 ): ?>
								<tr>
									<td colspan="5" class="text-center">Tidak ada menu</td>
								</tr>
							<?php else: ?>
								<?php foreach ($get_data as $row): ?>
									<tr>
										<td><?= $row['nama_menu'] ?></td>
										<td>Rp.<?= number_format($row['harga']) ?></td>
										<td>
											<a href="<?= $myfunc->baseurl ?>order_pesan.php?id=<?= $row['id_menu'] ?>" class="btn btn-primary btn-sm">Pesan</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'config/templates/footer.php';
?>