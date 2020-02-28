<?php 

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

	public function redirect($link)
	{
		header("Location: $link");
	}

	public function notif($msg)
	{
		echo "<script>alert('$msg')</script>";
	}

	public function set_breadcrumb($list)
	{
		$this->breadcrumb = $list;
	}

	public function set_title($title)
	{
		$this->title = $title;
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
		if ( mysql_affected_rows($this->conn) > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}
	
}