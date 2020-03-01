<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Transaksi");
	$myfunc->set_title("Transaksi");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "kasir") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}

	if ( isset($_POST['search']) ) {
		# code...
	} else {
		$get_data = $myfunc->get_all_transaksi();
	}

	if ( isset($_POST['bayar']) ) {
		$myfunc->transaksi_selesai($_POST);
	}
?>
<?php foreach ($get_data as $row): ?>
	<?php 
		$customer = $myfunc->get_pelanggan($row['id_pelanggan']);
		$get_pesanan = $myfunc->get_pesanan($row['id_transaksi']);
		$total_transaksi = $myfunc->get_total_transaksi($row["id_transaksi"]);
		$get_meja = $myfunc->get_meja($row['id_meja']);
	?>
	<div class="row mb-5">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					
					<div class="row">
						
						<div class="col-12">
							<div class="alert alert-success" role="alert">
							  Pesanan #<?= $row['id_transaksi'] ?>
							</div>
						</div>

						<div class="col-12">
							<h5 class="text-muted">Data Pelanggan</h5>
						</div>
						<div class="col-2">Nama</div>
						<div class="col-10">: <?= $customer['nama'] ?></div>
						<div class="col-2">Jenis Kelamin</div>
						<div class="col-10">: <?= ucwords($customer['jk']) ?></div>
						<div class="col-2">Nomor HP</div>
						<div class="col-10">: <?= $customer['nohp'] ?></div>
						<div class="col-2">Alamat</div>
						<div class="col-10">: <?= $customer['alamat'] ?></div>
						<div class="col-2">Meja</div>
						<div class="col-10">: <?= $get_meja['meja'] ?></div>

						<div class="col-12 mt-4">
							<h5 class="text-muted">Data Pesanan</h5>
						</div>
						<div class="col-12">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Menu</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($get_pesanan as $pesan): ?>
											<?php $menu = $myfunc->get_menu($pesan['id_menu']) ?>
											<tr>
												<td><?= $menu['nama_menu'] ?></td>
												<td>Rp.<?= number_format($menu['harga']) ?></td>
												<td><?= $pesan['jumlah'] ?></td>
												<td>Rp.<?= number_format($menu['harga'] * $pesan['jumlah']) ?></td>
											</tr>
										<?php endforeach ?>
										<tr>
											<th colspan="3" class="text-right">Total :</th>
											<th>Rp.<?= number_format($total_transaksi) ?></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
						<div class="col-12">
							<form class="form-inline" action="" method="post">
								<input type="number" name="jumlah" class="form-control" placeholder="Bayar">
								<button type="submit" name="bayar" class="btn btn-success ml-2" value="<?= $row['id_transaksi'] ?>">Bayar</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php 
	include 'config/templates/footer.php';
?>