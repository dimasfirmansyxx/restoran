<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Meja");
	$myfunc->set_title("Meja");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "owner") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}


	$get_data = $myfunc->get_all_meja();

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
						List Meja
					</div>
					<div class="col-md-6 text-right">
						<a href="meja_tambah.php" class="btn btn-primary btn-sm">Tambah Meja</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="50">#</th>
								<th>Meja</th>
								<th width="200">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( $get_data == 3 ): ?>
								<tr>
									<td colspan="3" class="text-center">Tidak ada meja</td>
								</tr>
							<?php else: ?>
								<?php $i = 1; 
								foreach ($get_data as $row): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $row['meja'] ?></td>
										<td>
											<a href="<?= $myfunc->baseurl ?>meja_edit.php?id=<?= $row['id_meja'] ?>" class="btn btn-primary btn-sm">Edit</a>
											<a href="<?= $myfunc->baseurl ?>meja.php?hapus=<?= $row['id_meja'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus ?')">Hapus</a>
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