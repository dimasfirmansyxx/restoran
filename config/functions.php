<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");
/*
	0 = sukses
	1 = kesalahan server
	2 = data ada
	3 = data tidak ada
*/

class functions {
	public $conn;
	public $breadcrumb;
	public $title;
	public $baseurl;

	public function __construct()
	{
		$this->conn = mysqli_connect('localhost','root','','restoran');
		$this->baseurl = "http://localhost/restoran/";
		$uri = explode("/", $_SERVER["REQUEST_URI"]);

		if ( !isset($_SESSION["user_logged"]) ) {
			if ( !($uri[2] == "login.php") ) {
				header("Location: " . $this->baseurl . "login.php");
			}
		} else {
			if ( $uri[2] == "login.php" ) {
				header("Location: " . $this->baseurl . "index.php");
			}
		}
	}

	public function num_rows($query)
	{
		$query = mysqli_query($this->conn,$query);
		return mysqli_num_rows($query);
	}

	public function query($query)
	{
		$query = mysqli_query($this->conn,$query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($query) ) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function exe($query)
	{
		$query = mysqli_query($this->conn,$query);

		if ( mysqli_affected_rows($this->conn) > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function get_data($query)
	{
		$query = mysqli_query($this->conn,$query);
		return mysqli_fetch_assoc($query);
	}

	public function redirect($link)
	{
		header("Location: $link");
		// echo "<script>window.location = " . $link . "; </script>";
	}

	public function notif($msg)
	{
		// echo "<script>alert('$msg')</script>";
		$_SESSION["flash_data"] = $msg;
	}

	public function set_breadcrumb($list)
	{
		$this->breadcrumb = $list;
	}

	public function set_title($title)
	{
		$this->title = $title;
	}

	public function login_check($data)
	{
		$username = $data['username'];
		$password = $data['password'];

		$query = "SELECT * FROM tbluser WHERE username = '$username'";
		if ( $this->num_rows($query) > 0 ) {
			$get = $this->get_data($query);
			if ( password_verify($password, $get['password']) ) {
				$_SESSION["user_logged"] = $get;
				header("Location: " . $this->baseurl . "index.php");
			} else {
				$this->notif("Password salah");
			}
		} else {
			$this->notif("Username tidak ada");
		}

		header("Location: " . $this->baseurl . "login.php");
	}

	public function logout()
	{
		session_destroy();	
		header("Location: " . $this->baseurl . "login.php");
	}

	public function get_id_transaksi()
	{
		$id_transaksi = date("YmdHis");
		$tanggal = date("Y-m-d");
		$user = $_SESSION["user_logged"]['id_user'];
		$query = "INSERT INTO tbltransaksi VALUES ('$id_transaksi','0','$user','0','$tanggal','pending')";
		$this->exe($query);

		return $id_transaksi;
	}

	public function get_all_menu()
	{
		$query = "SELECT * FROM tblmenu";
		if ( $this->num_rows($query) > 0 ) {
			return $this->query($query);
		} else {
			return 3;
		}
	}

	public function tambah_menu($data)
	{
		$nama_menu = ucwords($data['nama']);
		$harga = $data['harga'];

		$insert = $this->exe("INSERT INTO tblmenu VALUES ('','$nama_menu','$harga')");
		if ( $insert == 0 ) {
			$this->notif("Sukses");
			$this->redirect($this->baseurl . "menu.php");
		} else {
			$this->notif("Gagal");
			$this->redirect($this->baseurl . "menu_tambah.php");
		}
	}

	public function hapus_menu($id)
	{
		$delete = $this->exe("DELETE FROM tblmenu WHERE id_menu = '$id'");
		return $delete;
	}

	public function edit_menu($data)
	{
		$id_menu = $data['id_menu'];
		$nama_menu = ucwords($data['nama_menu']);
		$harga = $data['harga'];

		$update = $this->exe("UPDATE tblmenu SET nama_menu = '$nama_menu', harga = '$harga' WHERE id_menu = '$id_menu'");
		if ( $update == 0 ) {
			$this->redirect($this->baseurl . "menu.php");
		} else {
			$this->notif("Gagal update");
			$this->redirect($this->baseurl . "menu_edit.php?id=$id_menu");
		}
	}
	
	public function get_all_meja()
	{
		$query = "SELECT * FROM tblmeja";
		if ( $this->num_rows($query) > 0 ) {
			return $this->query($query);
		} else {
			return 3;
		}
	}

	public function tambah_meja($data)
	{
		$meja = $data['meja'];

		$insert = $this->exe("INSERT INTO tblmeja VALUES ('','$meja')");
		if ( $insert == 0 ) {
			$this->notif("Sukses");
			$this->redirect($this->baseurl . "meja.php");
		} else {
			$this->notif("Gagal");
			$this->redirect($this->baseurl . "meja_tambah.php");
		}
	}

	public function hapus_meja($id)
	{
		$delete = $this->exe("DELETE FROM tblmeja WHERE id_meja = '$id'");
		return $delete;
	}

	public function edit_meja($data)
	{
		$id_meja = $data['id_meja'];
		$meja = $data['meja'];

		$update = $this->exe("UPDATE tblmeja SET meja = '$meja' WHERE id_meja = '$id_meja'");
		if ( $update == 0 ) {
			$this->redirect($this->baseurl . "meja.php");
		} else {
			$this->notif("Gagal update");
			$this->redirect($this->baseurl . "meja_edit.php?id=$id_meja");
		}
	}

	public function get_all_pelanggan()
	{
		$query = "SELECT * FROM tblpelanggan";
		if ( $this->num_rows($query) > 0 ) {
			return $this->query($query);
		} else {
			return 3;
		}
	}

	public function tambah_pelanggan($data)
	{
		$nama = ucwords($data['nama']);
		$jk = $data['jk'];
		$nohp = $data['nohp'];
		$alamat = $data['alamat'];

		$insert = $this->exe("INSERT INTO tblpelanggan VALUES ('','$nama','$jk','$nohp','$alamat')");
		if ( $insert == 0 ) {
			$this->notif("Sukses");
			$this->redirect($this->baseurl . "cust.php");
		} else {
			$this->notif("Gagal");
			$this->redirect($this->baseurl . "cust_tambah.php");
		}
	}

	public function hapus_pelanggan($id)
	{
		$delete = $this->exe("DELETE FROM tblpelanggan WHERE id_pelanggan = '$id'");
		return $delete;
	}

	public function edit_pelanggan($data)
	{
		$id_pelanggan = $data['id_pelanggan'];
		$nama = ucwords($data['nama']);
		$jk = $data['jk'];
		$nohp = $data['nohp'];
		$alamat = $data['alamat'];

		$update = $this->exe("UPDATE tblpelanggan SET nama = '$nama', jk = '$jk', nohp = '$nohp', alamat = '$alamat' WHERE id_pelanggan = '$id_pelanggan'");
		if ( $update == 0 ) {
			$this->redirect($this->baseurl . "cust.php");
		} else {
			$this->notif("Gagal update");
			$this->redirect($this->baseurl . "cust_edit.php?id=$id_pelanggan");
		}
	}

	public function get_all_user()
	{
		$query = "SELECT * FROM tbluser WHERE id_user <> " . $_SESSION["user_logged"]['id_user'];
		if ( $this->num_rows($query) > 0 ) {
			return $this->query($query);
		} else {
			return 3;
		}
	}

	public function tambah_user($data)
	{
		$nama = ucwords($data['nama']);
		$username = $data['username'];
		$password = password_hash($data['password'], PASSWORD_DEFAULT);
		$privilege = $data['privilege'];

		if ( $this->num_rows("SELECT * FROM tbluser WHERE username = '$username'") > 0 ) {
			$this->notif("Username sudah ada");
			$this->redirect($this->baseurl . "user_tambah.php");
		} else {
			$insert = $this->exe("INSERT INTO tbluser VALUES ('','$nama','$username','$password','$privilege')");
			if ( $insert == 0 ) {
				$this->notif("Sukses");
				$this->redirect($this->baseurl . "user.php");
			} else {
				$this->notif("Gagal");
				$this->redirect($this->baseurl . "user_tambah.php");
			}
		}

	}

	public function hapus_user($id)
	{
		$delete = $this->exe("DELETE FROM tbluser WHERE id_user = '$id'");
		return $delete;
	}

	public function edit_user($data)
	{
		$id_user = $data['id_user'];
		$nama = ucwords($data['nama']);
		$privilege = $data['privilege'];

		$update = $this->exe("UPDATE tbluser SET nama = '$nama', privilege = '$privilege' WHERE id_user = '$id_user'");
		if ( $update == 0 ) {
			$this->redirect($this->baseurl . "user.php");
		} else {
			$this->notif("Gagal update");
			$this->redirect($this->baseurl . "user_edit.php?id=$id_user");
		}
	}
}