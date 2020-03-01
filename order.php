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

	if ( !isset($_SESSION["id_transaksi"]) ) {
		$_SESSION["id_transaksi"] = $myfunc->get_id_transaksi();
	}

	$get_data = $myfunc->get_all_menu();
	$get_cust = $myfunc->get_all_pelanggan();
	$get_cart = $myfunc->get_cart();
	$total_transaksi = $myfunc->get_total_transaksi($_SESSION["id_transaksi"]);

	if ( isset($_POST['cart']) ) {
		if ( $_POST['qty'] == 0 ) {
			$myfunc->notif("Qty harus lebih dari 1");
			$myfunc->redirect($myfunc->baseurl . "order.php");
		} elseif ( !(is_numeric($_POST['qty'])) ) {
			$myfunc->notif("Isi qty hanya dengan angka");
			$myfunc->redirect($myfunc->baseurl . "order.php");
		} else {
			$myfunc->add_cart($_POST);
		}
	} elseif ( isset($_GET['hapus']) ) {
		$myfunc->del_cart($_GET['hapus']);
	} elseif ( isset($_GET['clear']) ) {
		$myfunc->clear_cart();
	}
?>
<div class="row">
	<div class="col-12 text-right mb-4">
		<form action="" method="post" class="form-inline">
			<select class="form-control mr-3" required name="pelanggan">
				<option value="0">--- Pilih Pelanggan ---</option>
				<?php foreach ($get_cust as $cust): ?>
					<option value="<?= $cust['id_pelanggan'] ?>"><?= $cust['nama'] ?></option>
				<?php endforeach ?>
			</select>
			<button class="btn btn-success mr-3" type="submit" name="pesan">Pesan</button>
			<a href="<?= $myfunc->baseurl ?>order.php?clear=" class="btn btn-danger mr-3">Batal</a>
		</form>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header bg-dark text-white">
				List Menu
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Menu</th>
								<th>Harga</th>
								<th width="100">Qty</th>
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
										<form action="" method="post">
											<td>
												<input type="number" name="qty" required class="form-control">
											</td>
											<td>
												<button type="submit" name="cart" value="<?= $row['id_menu'] ?>" class="btn btn-primary btn-sm">Pesan</a>
											</td>
										</form>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-7">
		<div class="card">
			<div class="card-header bg-dark text-white">
				List Pesanan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="50">#</th>
								<th>Menu</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( $get_cart == 3 ): ?>
								<tr>
									<td colspan="5" class="text-center">Tidak ada menu</td>
								</tr>
							<?php else: ?>
								<?php foreach ($get_cart as $row): ?>
									<?php $menu = $myfunc->get_menu($row['id_menu']) ?>
									<tr>
										<td>
											<a href="<?= $myfunc->baseurl ?>order.php?hapus=<?= $row['id_pesan'] ?>" class="btn btn-danger btn-sm">x</a>
										</td>
										<td><?= $menu['nama_menu'] ?></td>
										<td>Rp.<?= number_format($menu['harga']) ?></td>
										<td><?= $row['jumlah'] ?></td>
										<td>Rp.<?= number_format($menu['harga'] * $row['jumlah']) ?></td>
									</tr>
								<?php endforeach ?>
								<tr>
									<th colspan="4" class="text-right">Total :</th>
									<th>Rp.<?= number_format($total_transaksi) ?></th>
								</tr>
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