<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_breadcrumb("Beranda / Menu");
	$myfunc->set_title("Menu");

	include 'config/templates/header.php';

	$get_data = $myfunc->get_all_menu();

	if ( isset($_GET['hapus']) ) {
		$delete = $myfunc->hapus_menu($_GET['hapus']);
		if ( $delete == 1 ) {
			$myfunc->notif("Gagal dihapus");
		}
		$myfunc->redirect($myfunc->baseurl . "menu.php");
	}
?>

<div class="card">
	<div class="card-header bg-dark text-white">
		<div class="row">
			<div class="col-md-6">
				List Menu
			</div>
			<div class="col-md-6 text-right">
				<a href="<?= $myfunc->baseurl ?>menu_tambah.php" class="btn btn-primary btn-sm">Tambah Menu</a>
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
						<th>Harga</th>
						<th width="200">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ( $get_data == 3 ): ?>
						<tr>
							<td colspan="4" class="text-center">Tidak ada menu</td>
						</tr>
					<?php else: ?>
						<?php $i = 1; 
						foreach ($get_data as $row): ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['nama_menu'] ?></td>
								<td>Rp.<?= number_format($row['harga']) ?></td>
								<td>
									<a href="<?= $myfunc->baseurl ?>menu_edit.php?id=<?= $row['id_menu'] ?>" class="btn btn-primary btn-sm">Edit</a>
									<a href="<?= $myfunc->baseurl ?>menu.php?hapus=<?= $row['id_menu'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus ?')">Hapus</a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php 
	include 'config/templates/footer.php';
?>