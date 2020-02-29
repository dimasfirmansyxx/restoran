<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / User");
	$myfunc->set_title("User");

	include 'config/templates/header.php';

	$privilege = $_SESSION["user_logged"]['privilege'];
	if ( !($privilege == "administrator" || $privilege == "owner") ) {
		$myfunc->redirect($myfunc->baseurl . "index.php");
	}


	$get_data = $myfunc->get_all_user();

	if ( isset($_GET['hapus']) ) {
		$delete = $myfunc->hapus_user($_GET['hapus']);
		if ( $delete == 1 ) {
			$myfunc->notif("Gagal dihapus");
		}
		$myfunc->redirect($myfunc->baseurl . "user.php");
	}
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-dark text-white">
				<div class="row">
					<div class="col-md-6">
						List User
					</div>
					<div class="col-md-6 text-right">
						<a href="user_tambah.php" class="btn btn-primary btn-sm">Tambah User</a>
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
								<th>Username</th>
								<th>Hak Akses</th>
								<th width="200">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( $get_data == 3 ): ?>
								<tr>
									<td colspan="5" class="text-center">Tidak ada user</td>
								</tr>
							<?php else: ?>
								<?php $i = 1; 
								foreach ($get_data as $row): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $row['nama'] ?></td>
										<td><?= $row['username'] ?></td>
										<td><?= ucwords($row['privilege']) ?></td>
										<td>
											<a href="<?= $myfunc->baseurl ?>user_edit.php?id=<?= $row['id_user'] ?>" class="btn btn-primary btn-sm">Edit</a>
											<a href="<?= $myfunc->baseurl ?>user.php?hapus=<?= $row['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus ?')">Hapus</a>
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