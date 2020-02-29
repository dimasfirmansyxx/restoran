<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Pelanggan");
	$myfunc->set_title("Pelanggan");

	include 'config/templates/header.php';

	$get_data = $myfunc->get_all_pelanggan();

	if ( isset($_GET['hapus']) ) {
		$delete = $myfunc->hapus_meja($_GET['hapus']);
		if ( $delete == 1 ) {
			$myfunc->notif("Gagal dihapus");
		}
		$myfunc->redirect($myfunc->baseurl . "meja.php");
	}
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-dark text-white">
				<div class="row">
					<div class="col-md-6">
						List Pelanggan
					</div>
					<div class="col-md-6 text-right">
						<a href="cust_tambah.php" class="btn btn-primary btn-sm">Tambah Pelanggan</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="50">#</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Nomor HP</th>
								<th>Alamat</th>
								<th width="200">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( $get_data == 3 ): ?>
								<tr>
									<td colspan="6" class="text-center">Tidak ada pelanggan</td>
								</tr>
							<?php else: ?>
								<?php $i = 1; 
								foreach ($get_data as $row): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $row['nama'] ?></td>
										<td><?= ucwords($row['jk']) ?></td>
										<td><?= $row['nohp'] ?></td>
										<td><?= $row['alamat'] ?></td>
										<td>
											<a href="<?= $myfunc->baseurl ?>cust_edit.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-primary btn-sm">Edit</a>
											<a href="<?= $myfunc->baseurl ?>cust.php?hapus=<?= $row['id_pelanggan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus ?')">Hapus</a>
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