<?php 

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

	public function set_breadcrumb($list)
	{
		$this->breadcrumb = $list;
	}

	public function set_title($title)
	{
		$this->title = $title;
	}
	
}