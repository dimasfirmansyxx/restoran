<?php 

class functions {
	public $conn;
	public $breadcrumb;
	public $title;

	public function __construct()
	{
		$this->conn = mysqli_connect('localhost','root','','restoran');
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