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
	
}